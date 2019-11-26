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
        <form class="kt-form kt-form--label-right">
          <div class="kt-portlet__body">
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">節目名稱：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限10個字" maxlength="10"
                  v-model="form.title">
              </div>
            </div>
						 <div class="form-group row">
              <label class="col-lg-3 col-form-label">選擇圖片：</label>
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
                    @change="handleUpload">
									<button class="btn btn-success">上傳圖片</button>
                  <small>建議上傳圖片比例為 1:1 且小於 2MB 之圖片檔</small>
								</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">主持人：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限20個字" maxlength="20"
                v-model="form.anchor">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">節目介紹：</label>
              <div class="col-lg-6">
                <textarea class="form-control" placeholder="" maxlength="500"
                  v-model="form.sub_title"></textarea>
              </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-2">
                  <button v-if="isEdit" type="button" class="btn btn-success">刪除</button>
                </div>
                <div class="col-10 text-right">
                  <button type="button" class="btn btn-secondary">取消</button>
                  <template>
                    <button v-if="!isEdit" type="button" class="btn btn-success" @click="handleCreate">新增</button>
                    <button v-else type="button" class="btn btn-success" @click="handleSave">儲存</button>
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
export default {
  props: {
    isEdit: {
      type: Boolean
    }
  },

  data () {
    return {
      category: '空中崇拜',
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


  mounted () {

  },

  methods: {
    handleCreate () {

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
      location.assign(location.origin + '/programs')
    },

    handleDeleteImage () {
      this.form.image = ''
      this.previewImage = ''
    },

    handleUpload (e) {
      console.log(e)

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
        console.log('圖片檔案超過2MB')
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
    }
  }

}
</script>

<style>

</style>