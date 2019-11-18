<template>
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-12">
      <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right">
          <div class="kt-portlet__body">
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">姓名:</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限中英數字">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">帳號:</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限英數字">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">密碼:</label>
              <div class="col-lg-6">
                <input type="password" class="form-control" placeholder="6-12位英數字密碼">
              </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">權限管理:</label>
                <div class="col-lg-6 kt-checkbox-list mt-2 pl-2">
                  <label class="kt-checkbox">
                        <input type="checkbox"> 帳號管理
                        <span></span>
                    </label>
                    <label class="kt-checkbox">
                        <input type="checkbox"> 節目分類
                        <span></span>
                    </label>
                    <label class="kt-checkbox">
                        <input type="checkbox"> 節目內容
                        <span></span>
                    </label>
                    <label class="kt-checkbox">
                        <input type="checkbox"> 最新消息
                        <span></span>
                    </label>
                    <label class="kt-checkbox">
                        <input type="checkbox"> 推播管理
                        <span></span>
                    </label>
                </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-2">
                  <button v-if="isEdit" type="reset" class="btn btn-success" @click="handleDelete">刪除</button>
                </div>
                <div class="col-10 text-right">
                  <button type="reset" class="btn btn-secondary" @click="handleCancel">取消</button>
                  <template>
                    <button v-if="!isEdit" type="reset" class="btn btn-success" @click="handleCreate">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      新增
                    </button>
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

  methods: {
    handleCreate () {

      if (true) {
        Swal.fire({
          timer: 6000,
          title: '新增成功'})
          .then(() => {
            location.assign(location.origin + '/accounts')
          })
      }
    },

    handleSave () {
      if (true) {
        Swal.fire({
          timer: 6000,
          title: '儲存變更'})
          .then(() => {
            location.assign(location.origin + '/accounts')
          })
      }
    },

    handleCancel () {
      Swal.fire({
        title: `是否要取消這次${isEdit ? '編輯' : '新增'}？如果取消${isEdit ? '編輯' : '新增'}的內容將不會被儲存。`,
        showCancelButton: true,
        confirmButtonText: '確定取消',
        cancelButtonText: '返回',
      })
        .then((result) => {
          if (result.value) {
            location.assign(location.origin + '/accounts')
          }
        })

    },

    handleDelete () {
      Swal.fire({
        title: `確定要刪除嗎？若刪除此帳號將無法回復。`,
        showCancelButton: true,
        confirmButtonText: '確定刪除',
        cancelButtonText: '返回',
      })
        .then((result) => {
          if (result.value) {
            Swal.fire({
              title: '帳號已刪除'
            })
            .then(() => {
              location.assign(location.origin + '/accounts')
            })
          }
        })
      }
    }

}
</script>

<style>

</style>