<template>
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-12">
      <div class="kt-portlet">
        <!--begin::Form-->
        <form class="createForm kt-form kt-form--label-right"
          data-parsley-validate="">
          <div class="kt-portlet__body">
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">姓名：</label>
              <div class="col-lg-6">
                <input
                  type="text"
                  class="form-control"
                  placeholder="限中英數字"
                  v-model="form.name"
                  name="name"
                  data-parsley-trigger="change"
                  data-parsley-pattern="^(\d|\w|[\u4E00-\u9FFF])+$"
                  data-parsley-required-message="必填欄位"
                  data-parsley-pattern-message="限英數字"
                  required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">帳號：</label>
              <div class="col-lg-6">
                <input
                  type="text"
                  class="form-control"
                  placeholder="限英數字"
                  data-parsley-pattern="^(\d|\w)+$"
                  data-parsley-trigger="change"
                  data-parsley-pattern-message="限英數字"
                  data-parsley-required-message="必填欄位"
                  required
                  v-model="form.email">
                  <div
                    v-for="msg in errors.email"
                    :key="msg"
                    style="color: red; margin-top: 2px; font-weight: 400;">{{ msg }}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">密碼：</label>
              <div class="col-lg-6">
                <input
                  type="password"
                  class="form-control"
                  placeholder="6-12位英數字密碼"
                  data-parsley-length="[6, 12]"
                  data-parsley-pattern="^(\d|\w)+$"
                  data-parsley-trigger="focusout"
                  data-parsley-required-message="必填欄位"
                  data-parsley-length-message="密碼長度應為6-12碼"
                  data-parsley-pattern-message="密碼不可包含符號"
                  v-model="form.password"
                  :required="!isEdit">
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
                  <button v-if="isEdit" type="button" class="btn btn-success" @click="handleDelete">刪除</button>
                </div>
                <div class="col-10 text-right">
                  <button type="button" class="btn btn-secondary" @click="handleCancel">取消</button>
                  <template>
                    <button v-if="!isEdit"
                      type="button"
                      class="btn btn-success"
                      @click="handleCreate"
                      :class="{'disabled': isEmpty}"
                      :disabled="isEmpty"
                    >
                      <span
                        :class="{'spinner-border spinner-border-sm': isSubmitting}"
                        role="status"
                        aria-hidden="true"></span>
                      新增
                    </button>
                    <button v-else
                      type="button"
                      class="btn btn-success"
                      @click="handleSave"
                      :class="{'disabled': isEmpty}"
                      :disabled="isEmpty">
                      <span
                        :class="{'spinner-border spinner-border-sm': isSubmitting}"
                        role="status"
                        aria-hidden="true"></span>
                      儲存
                    </button>
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
import { isArray } from 'util'
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
      isSubmitting: false,
      errors: {
        email: '',
      }
    }
  },

  computed: {
    isEmpty () {
      const requiedFields = [
        'name',
				'email',
				'password',
				'roles'
      ]
      return requiedFields
				.map(field => typeof this.form[field] === 'object' ? this.form[field].length : this.form[field])
				.some(v => !v)
    }
  },

  created () {
    if (this.isEdit) {
      this.setForm()
    }
  },

  mounted () {
    $('.createForm').parsley()
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

      var instance = $('.createForm').parsley();
      if (!instance.isValid()) return

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
      .catch(err => {
        const { errors } = err.response.data

        if (errors.email.length) {
          this.errors.email = errors.email
        }
      })
      .finally(() => this.isSubmitting = false)
    },

    handleSave () {
      var instance = $('.createForm').parsley();

      if (!instance.isValid()) return

        this.isSubmitting = true
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
