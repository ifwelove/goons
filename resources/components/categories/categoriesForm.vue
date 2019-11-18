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
                <input type="text" class="form-control" placeholder="限30個字" maxlength="30">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">節目名稱：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限10個字" maxlength="10">
              </div>
            </div>
						 <div class="form-group row">
              <label class="col-lg-3 col-form-label">選擇圖片：</label>
              <div class="col-lg-6">

								<div class="image-wrapper position-relative" style="width: 50%; height: auto;">
									<img src="http://placekitten.com/600/400" alt="" style="width: 100%; height: auto;">
									<div class="kt-demo-icon__preview">
										<i class="flaticon-cancel"></i>
									</div>
									<i class="flaticon-cancel position-absolute pointer-cursor" style="top: 0; right: 0;"></i>
								</div>

								<div class="custom-file">
									<input type="file" class="custom-file-input position-absolute" id="customFile">
									<button class="btn btn-success">上傳圖片</button>
								</div>

								<!-- <div class="kt-avatar" id="kt_profile_avatar_1">
									<div class="kt-avatar__holder"></div>
									<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
										<i class="fa fa-pen"></i>
										<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
									</label>
									<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
										<i class="fa fa-times"></i>
									</span>
								</div> -->
								<!-- <div class="dropzone dropzone-multi" id="upload_image">
									<div class="dropzone-panel">
										<a class="dropzone-select btn btn-label-brand btn-bold btn-sm dz-clickable">上傳圖片</a>
										<a class="dropzone-upload btn btn-label-brand btn-bold btn-sm">Upload All</a>
										<a class="dropzone-remove-all btn btn-label-brand btn-bold btn-sm">Remove All</a>
									</div>
									<div class="dropzone-items">
									</div>
									<div class="dz-default dz-message"><span>Drop files here to upload</span>
									</div>
								</div> -->
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">主持人：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限20個字" maxlength="20">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">節目介紹：</label>
              <div class="col-lg-6">
                <textarea class="form-control" placeholder="" maxlength="500"></textarea>
              </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-2">
                  <button v-if="isEdit" type="reset" class="btn btn-success">刪除</button>
                </div>
                <div class="col-10 text-right">
                  <button type="reset" class="btn btn-secondary">取消</button>
                  <template>
                    <button v-if="!isEdit" type="reset" class="btn btn-success" @click="handleCreate">新增</button>
                    <button v-else type="reset" class="btn btn-success" @click="handleSave">儲存</button>
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
      endDate: ''
    }
  },


  mounted () {
    this.$nextTick(() => {
			// jQuery
			// $("#upload_image").dropzone({ url: "/file/post" });
    })
  },


  methods: {
    handleCreate () {
      location.assign(location.origin + '/programs')
    },

    handleSave () {
      location.assign(location.origin + '/programs')
    }
  }

}
</script>

<style>

</style>