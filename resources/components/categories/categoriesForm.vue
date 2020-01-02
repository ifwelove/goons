<template>
<div class="container-fluid mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/categories">節目分類</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ isEdit ? '編輯' : '新增'}}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-12">
      <div class="kt-portlet">
        <!--begin::Form-->
        <form class="categoriesForm kt-form kt-form--label-right" data-parsley-validate>
          <div class="kt-portlet__body">
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>節目名稱：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限10個字" maxlength="10"
                  v-model="form.title" required>
              </div>
            </div>
						 <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>選擇圖片：</label>
              <div class="col-lg-6">
								<div
                  v-if="form.image"
                  class="image-wrapper position-relative" style="width: 50%; height: auto;">
									<img :src="previewImage" alt="" style="width: 100%; height: auto;">
                  <div
                    class="close position-absolute"
                    style="top: 0; right: 0; font-size: 20px;"
                    @click="handleDeleteImage">
                    <i class="fa fa-window-close"></i>
                  </div>
								</div>

								<div v-else class="custom-file">
									<input type="file" class="custom-file-input position-absolute" id="customFile"
                    @change="handleUpload" required>
									<button class="btn btn-success">上傳圖片</button>
                  <small>建議上傳圖片比例為 1:1 且小於 2MB 之圖片檔</small>
								</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>主持人：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限20個字" maxlength="20"
                v-model="form.anchor" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>節目介紹：</label>
              <div class="col-lg-6">
                <textarea class="form-control" placeholder="" maxlength="500"
                  v-model="form.sub_title" required></textarea>
              </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-2">
                  <button v-if="isEdit" type="button" class="btn btn-success" @click="handleDelete">刪除</button>
                </div>
                <div class="col-10 text-right">
                  <button type="button" class="btn btn-secondary"
                    @click="handleCancel">取消</button>
                  <template>
                    <button
                      v-if="!isEdit" type="button" class="btn btn-success" @click="handleCreate"
                      :class="{'disabled': isEmpty}"
                      :disabled="isEmpty">
                      <span
                        :class="{'spinner-border spinner-border-sm': isSubmitting}"
                        role="status"
                        aria-hidden="true"></span>
                      新增</button>
                    <button v-else type="button" class="btn btn-success" @click="handleSave"
                            :class="{'disabled': isEmpty}"
                            :disabled="isEmpty">
                      <span
                        :class="{'spinner-border spinner-border-sm': isSubmitting}"
                        role="status"
                        aria-hidden="true"></span>
                        儲存</button>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div> <!-- end col -->
  </div>
</div><!-- container -->
</template>

<script>
const queryString = require('query-string');

export default {
  props: {
    isEdit: {
      type: Boolean
    },
    categoryId: {
      type: Number
    }
  },

  data () {
    return {
      isSubmitting: false,
      startDate: '',
      endDate: '',
      previewImage: '',
      form: {
        title: '',
        sub_title: '',
        anchor: '',
        image: ''
      }
    }
  },

  computed: {
    isEmpty () {
      return Object.values(this.form).some(v => v === '')
    }
  },

  created () {
    if (this.isEdit) {
      this.getCategory()
    }
  },

  methods: {
    getCategory () {
      const uri = `/api/categories/${this.categoryId}/edit`
      axios.get(uri)
      .then((res) => {
        const { anchor, image, sub_title, title } = res.data.category

        this.form = {
          anchor, image, sub_title, title
        }
        this.previewImage = image
      })
    },

    handleCreate () {

      var instance = $('.categoriesForm').parsley();
      if (!instance.isValid()) return

      this.isSubmitting = true

      const uri = `/api/categories`
      axios.post(uri, {
        ...this.form
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '新增成功'})
          .then(() => {
            location.assign(location.origin + '/categories')
          })
      })
    },

    handleSave () {
      var instance = $('.categoriesForm').parsley();
      if (!instance.isValid()) return

      this.isSubmitting = true
      const uri = `/api/categories/${this.categoryId}`
      axios.put(uri, {
        ...this.form
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '儲存變更'})
          .then(() => {
            location.assign(location.origin + '/categories')
          })
      })
    },

    handleCancel () {
      Swal.fire({
        title: `是否要取消這次${this.isEdit ? '編輯' : '新增'}？如果取消${this.isEdit ? '編輯' : '新增'}的內容將不會被儲存。`,
        showCancelButton: true,
        confirmButtonText: '確定取消',
        cancelButtonText: '返回',
      })
        .then((result) => {
          if (result.value) {
            location.assign(location.origin + '/categories')
          }
        })
    },

    handleDeleteImage () {
      this.form.image = ''
      this.previewImage = ''
    },

    handleUpload (e) {
      const file = e.target.files[0]
      const isValid = this.validateImageSize(file)
      if (!isValid) return

      this.setPreviewImage(e)

      var formData = new FormData();
      formData.append("image", file);

      const uri = `/api/categories/image`
      axios.post(uri, formData)
      .then((res) => {
        this.form.image = res.data.imagePath
      })
    },

    validateImageSize (file) {
      if ((file.size / (1024 ** 2)) >  2) {
        Swal.fire({
          title: `圖片檔案超過2MB`
        })
        return false
      }
      return true
    },

    setPreviewImage (event) {
      var reader = new FileReader();
      reader.onload = () => {
        this.previewImage = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    },

    deleteConfirm () {
      return new Promise((resolve, reject) => {
        Swal.fire({
          title: `確定要刪除嗎？若刪除此節目將無法回復。`,
          showCancelButton: true,
          confirmButtonText: '確定刪除',
          cancelButtonText: '返回',
        })
        .then((result) => {
          if (result.value) {
            resolve()
          }
        })
      })
    },

    handleDelete () {
      this.deleteConfirm()
        .then(() => {
          const uri = `/api/categories/${this.categoryId}`
          axios.delete(uri)
          .then(() => {
            Swal.fire({
              title: '節目已刪除'
            })
            .then(() => {
              location.assign(location.origin + '/categories')
            })
          })
        })
      }

  }

}
</script>

<style>

</style>
