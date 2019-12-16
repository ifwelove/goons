<template>
<div class="container-fluid mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/programs">節目管理</a></li>
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
                 <select id="selectpicker" class="my-select selectpicker w-auto mr-2"
                  v-model="form.categories">
                     <option
                      v-for="categoryItem in categories"
                      :key="categoryItem.id"
                      :value="categoryItem.id">{{ categoryItem.title }}</option>
                  </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">單集節目名稱：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限30個字" maxlength="30"
                  v-model="form.title">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">主持人：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限15個字" maxlength="15"
                  v-model="form.anchor">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">音檔位址：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="http://"
                v-model="form.url">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">指定上架日期：</label>
              <div class="col-10 col-lg-6">
                <div class="input-group date">
                  <input type="text" class="form-control" readonly=""
                    v-model="form.start_date"
                    id="datepicker_start"
                    placeholder="請選擇日期">
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fa fa-calendar-alt glyphicon-th"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-2 col-lg-3">
                <button type="button" class="btn btn-success"
                  @click="handleResetDate('start_date')">清除</button>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">指定下架日期：</label>
              <div class="col-10 col-lg-6">
                 <div class="input-group date">
                  <input type="text" class="form-control" id="datepicker_end"
                    placeholder="請選擇日期"
                    v-model="form.end_date">
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fa fa-calendar-alt glyphicon-th"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-2 col-lg-3">
                <button type="button" class="btn btn-success"
                  @click="handleResetDate('end_date')">清除</button>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">單集簡介：</label>
              <div class="col-lg-6">
                <textarea class="form-control" placeholder="" maxlength="300"
                  v-model="form.sub_title"></textarea>
              </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-2">
                  <button v-if="isEdit" type="button" class="btn btn-success"
                    @click="handleDelete">刪除</button>
                </div>
                <div class="col-10 text-right">
                  <button type="button" class="btn btn-secondary"
                    @click="handleCancel">取消</button>
                  <template>
                    <button v-if="!isEdit" type="button" class="btn btn-success"
                      :class="{'disabled': isEmpty}"
                      :disabled="isEmpty"
                      @click="handleCreate">
                      <span
                        :class="{'spinner-border spinner-border-sm': isSubmitting}"
                        role="status"
                        aria-hidden="true"></span>
                        新增</button>
                    <button v-else type="button" class="btn btn-success"
                      @click="handleSave">
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
import format from 'date-fns/format'
import addDays from 'date-fns/addDays'
import axios from '../../js/utils/axios'

export default {
  props: {
    isEdit: {
      type: Boolean
    },
    programId: {
      type: Number
    }
  },

  data () {
    return {
      categories: [],
      isSubmitting: false,
      form: {
        categories: '',
        title: '',
        sub_title: '',
        anchor: '',
        url: '',
        start_date: '',
        end_date: ''
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
      this.getPrograms()
    }
  },

  mounted () {
    this.getProgramCategories()
    this.initForm()

   this.$nextTick(() => {
    $('#datepicker_start, #datepicker_end').datetimepicker({
      format: "yyyy/mm/dd hh:ii",
      autoclose: true
    });

    $('#datepicker_start').datetimepicker({
      format: "yyyy/mm/dd hh:ii",
      startDate: new Date()
    });

    $('#datepicker_start').on('changeDate', () => {
      this.form.start_date = $('#datepicker_start').datetimepicker('getFormattedDate')
      this.form.end_date = format(addDays(new Date(this.form.start_date), 7), 'yyyy/MM/dd hh:mm')
    });

    $('#datepicker_end').on('changeDate', () => {
      this.form.end_date = $('#datepicker_end').datetimepicker('getFormattedDate')
    });

    })

  },

  updated () {
		$('.my-select').selectpicker();
		$('#selectpicker').selectpicker('refresh');
  },

  methods: {
    initForm () {
      const { category } = queryString.parse(location.search)
      this.form.categories = Number(category)
    },

    getProgramCategories () {

      const params = {
        category: this.form.categories
      }

      const uri = `/api/programs`
      axios.get(uri, {
        params
      })
      .then((res) => {
        this.categories = res.data.categories
        $('#selectpicker').selectpicker();
      })

    },

    getPrograms () {
      const uri = `/api/programs/${this.programId}/edit`
      axios.get(uri)
      .then((res) => {
        const { anchor, categories, sub_title, title, start_date, end_date, url } = res.data.program

        this.form = {
          anchor, categories, sub_title, title, start_date, end_date, url
        }
      })
    },

    handleResetDate (field) {
      this.form[field] = ''
    },

    handleCreate () {

      this.isSubmitting = true

      const uri = `/api/programs`
      axios.post(uri, {
        ...this.form
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '新增成功'})
          .then(() => {
            location.assign(location.origin + '/programs')
          })
      })
    },

    handleSave () {

      this.isSubmitting = true
      const uri = `/api/programs/${this.programId}`
      axios.put(uri, {
        ...this.form
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '儲存變更'})
          .then(() => {
            location.assign(location.origin + '/programs')
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
            location.assign(location.origin + '/programs')
          }
        })
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
          const uri = `/api/programs/${this.programId}`
          axios.delete(uri)
          .then(() => {
            Swal.fire({
              title: '節目已刪除'
            })
            .then(() => {
              location.assign(location.origin + '/programs')
            })
          })
        })
    }
  }

}
</script>

<style>

</style>