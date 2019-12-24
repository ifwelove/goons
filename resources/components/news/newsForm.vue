<template>
<div class="container-fluid mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/news">最新消息</a></li>
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
              <label class="col-lg-3 col-form-label">標題：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限50個字" maxlength="50" required
                  v-model="form.title" >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-lg-3 col-form-label">指定上架日期：</label>
              <div class="col-6 col-lg-3">
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
              <div class="col-6 col-lg-3">
                <button type="button" class="btn btn-success"
                  @click="handleResetDate('start_date')">清除</button>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">指定下架日期：</label>
              <div class="col-6 col-lg-3">
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
              <div class="col-6 col-lg-3">
                <button type="button" class="btn btn-success"
                  @click="handleResetDate('end_date')">清除</button>
              </div>
            </div>

						<div class="form-group row">
              <label class="col-lg-3 col-form-label">自動推播：
							</label>
              <div class="col-6">
								<div class="kt-radio-inline">
									<label class="kt-radio">
										<input type="radio" :value="0" v-model="form.auto_push"> 否
										<span></span>
									</label>
									<label class="kt-radio">
										<input type="radio" :value="1" v-model="form.auto_push"> 是（與上架日起推播）
										<span></span>
									</label>
								</div>
              </div>
						</div>

            <div class="form-group row">
              <label class="col-lg-3 col-form-label">消息內容：</label>
              <div class="col-lg-6">
								<div class="summernote" v-html="form.description">{{ form.description }}</div>
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
                      :class="{'disabled': isEmpty}"
                      :disabled="isEmpty"
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
		},
		id: {
			type: Number
		}
  },

  data () {
    return {
      categories: [],
      isSubmitting: false,
      form: {
        title: '',
				description: '',
				auto_push: '',
				start_date: '',
				end_date: ''
			}
		}
  },

  computed: {
    isEmpty () {
      const requiedFields = [
        'title',
				'description',
				'auto_push',
				'start_date'
      ]
      return requiedFields
				.map(field => this.form[field])
				.some(v => v === '')
    }
  },

  created () {
    if (this.isEdit) {
      this.getNews()
    }
  },

  mounted () {
    if (!this.isEdit) {
      this.initEditor()
    }

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
				this.form.end_date = format(addDays(new Date(this.form.start_date), 365), 'yyyy/MM/dd hh:mm')
			});

			$('#datepicker_end').on('changeDate', () => {
				this.form.end_date = $('#datepicker_end').datetimepicker('getFormattedDate')
			});

    })

  },

  methods: {
    initEditor () {
      $('.summernote').summernote({
        height: 300,
        popover: {
          image: []
        },
        callbacks: {
          onChange: (contents, $editable) => {
            this.form.description = contents
          }
        }
      })
    },

    getNews () {
      const uri = `/api/news/${this.id}/edit`
      axios.get(uri)
      .then(res => {
				const { auto_push, description, start_date, end_date, title } = res.data.news
				this.form = {
					auto_push, description, start_date, end_date, title
        }
        this.form.description = description
        this.$nextTick(() => {
          this.initEditor()
        })
      })
    },

    handleResetDate (field) {
      this.form[field] = ''
    },

    handleCreate () {
      this.isSubmitting = true

      if (!this.form.end_date) {
        this.form.end_date = format(addDays(new Date(this.form.start_date), 365), 'yyyy/MM/dd hh:mm')
      }

      const uri = `/api/news`
      axios.post(uri, {
        ...this.form
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '新增成功'})
          .then(() => {
            location.assign(location.origin + '/news')
          })
      })
    },

    handleSave () {

      this.isSubmitting = true
      const uri = `/api/news/${this.id}`
      axios.put(uri, {
        ...this.form
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '儲存變更'})
          .then(() => {
            location.assign(location.origin + '/news')
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
            location.assign(location.origin + '/news')
          }
        })
    },

    deleteConfirm () {
      return new Promise((resolve, reject) => {
        Swal.fire({
          title: `確定要刪除嗎？若刪除此消息將無法回復。`,
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
          const uri = `/api/news/${this.id}`
          axios.delete(uri)
          .then(() => {
            Swal.fire({
              title: '消息已刪除'
            })
            .then(() => {
              location.assign(location.origin + '/news')
            })
          })
        })
    }
  }

}
</script>

<style>

</style>
