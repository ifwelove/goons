<template>
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-12">
      <div class="kt-portlet">
        <!--begin::Form-->
        <form ref="createForm" class="createForm kt-form kt-form--label-right"
        data-parsley-validate="">
          <div class="kt-portlet__body">
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">姓名：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限中英數字" v-model="form.name" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">帳號：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限英數字"
                  data-parsley-type="digits"
                  data-parsley-trigger="change"
                  required=""
                  v-model="form.email">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">密碼：</label>
              <div class="col-lg-6">
                <input type="password" class="form-control" placeholder="6-12位英數字密碼" v-model="form.password">
              </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">權限管理：</label>
                <div class="col-lg-6 kt-checkbox-list mt-2 pl-2">
                  <label class="kt-checkbox">
                        <input type="checkbox" v-model="form.roles" value="1"> 帳號管理
                        <span></span>
                    </label>
                    <label class="kt-checkbox">
                        <input type="checkbox" v-model="form.roles" value="2"> 節目分類
                        <span></span>
                    </label>
                    <label class="kt-checkbox">
                        <input type="checkbox" v-model="form.roles" value="3"> 節目內容
                        <span></span>
                    </label>
                    <label class="kt-checkbox">
                        <input type="checkbox" v-model="form.roles" value="4"> 最新消息
                        <span></span>
                    </label>
                    <label class="kt-checkbox">
                        <input type="checkbox" v-model="form.roles" value="5"> 推播管理
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
                      <span
                        :class="{'spinner-border spinner-border-sm': isSubmitting}"
                        role="status"
                        aria-hidden="true"></span>
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
    },
    account: {
      type: Object
    }
  },

  data () {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        roles: []
      },
      isSubmitting: false
    }
  },

  created () {
    if (this.isEdit) {
      this.setForm()
    }
  },

  methods: {
    setForm () {
      const {
        name, email, password,
        roles
      } = this.account

      const rolesValue = roles.map(role => role.id)

      this.form = {
        name, email, password, roles: rolesValue
      }
    },

    handleCreate () {

      // $('.createForm').parsley();

      // $('.createForm').validate()

      // return

      this.isSubmitting = true
      const uri = `/api/accounts`
      axios.post(uri, {
        name: this.form.name,
        email: this.form.email,
        password: this.form.password,
        roles: this.form.roles
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '新增成功'})
          .then(() => {
            location.assign(location.origin + '/accounts')
          })
      })
    },

    handleSave () {
      const uri = `/api/accounts/${this.account.id}`
      axios.put(uri, {
        name: this.form.name,
        email: this.form.email,
        password: this.form.password,
        roles: this.form.roles
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '儲存變更'})
          .then(() => {
            location.assign(location.origin + '/accounts')
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
            location.assign(location.origin + '/accounts')
          }
        })
    },

    deleteConfirm () {
      return new Promise((resolve, reject) => {
        Swal.fire({
          title: `確定要刪除嗎？若刪除此帳號將無法回復。`,
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
          const uri = `/api/accounts/${this.account.id}`
          axios.delete(uri)
          .then(() => {
            Swal.fire({
              title: '帳號已刪除'
            })
            .then(() => {
              location.assign(location.origin + '/accounts')
            })
          })
        })
      }
    }
}
</script>

<style>

</style>