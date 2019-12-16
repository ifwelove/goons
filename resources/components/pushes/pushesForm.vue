<template>
<div class="container-fluid mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/pushs">推播</a></li>
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
                <input type="text" class="form-control" placeholder="限50個字" maxlength="30" required
                  v-model="form.title" >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-lg-3 col-form-label">
								<span class="text-danger">*</span>推播內容：</label>
              <div class="col-lg-6">
								<textarea class="form-control" placeholder="限100字" maxlength="100"
                  v-model="form.sub_title" required></textarea>
              </div>
            </div>

						<div class="form-group row">
              <label class="col-lg-3 col-form-label">
								<span class="text-danger">*</span>跳轉位址：</label>
              <div class="col-lg-6">
								<select id="firstClass" class="my-select selectpicker w-auto mr-2"
									title="請先選擇區域"
									v-model="form.firstClass">
									<option
										v-for="(item, index) in options.firstClass"
										:key="index"
										:value="item.id"
										>{{ item }}
									</option>
								</select>
								<select
									id="secClass"
									v-if="form.firstClass"
									class="my-select selectpicker w-auto mr-2"
									title="請先選擇區域"
									v-model="form.secClass"
									@change="handleSecClass">
									<option
										v-for="(item, index) in options.secClass"
										:key="index"
										:value="item.id"
										>{{ item.title }}
									</option>
								</select>
								<select
									id="lastClass"
									v-if="form.secClass"
									class="my-select selectpicker w-auto mr-2"
									title="請先選擇區域"
									v-model="form.lastClass">
									<option
										v-for="(item, index) in lastClassOptions"
										:key="index"
										:value="item.id"
										>{{ item.title }}
									</option>
								</select>
              </div>
            </div>

						<div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>推播時間：</label>
              <div class="col-6">
								<div class="kt-radio-inline">
									<label class="kt-radio">
										<input type="radio" :value="1" v-model="form.status" @change="handleStatus"> 立即發佈
										<span></span>
									</label>

									<div>
										<label class="kt-radio">
											<input type="radio" :value="0" v-model="form.status" @change="handleStatus"> 預約發佈
											<span></span>
										</label>
										<div class="form-group row">
											<div class="col-6">
											<div class="input-group date">
												<input type="text" class="form-control" readonly=""
													v-model="form.start_date"
													id="datepicker_start"
													placeholder="請選擇日期"
													:disabled="form.status === 1">
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="fa fa-calendar-alt glyphicon-th"></i>
													</span>
												</div>
												</div>
											</div>
											<div class="col-3">
												<button type="button" class="btn btn-success"
													@click="handleResetDate('start_date')">清除</button>
											</div>
										</div>
									</div>

								</div>
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
                      @click="handleSave"
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
			options: {
				firstClass: {},
				secClass: {},
				lastClass: {}
			},
      isSubmitting: false,
      form: {
				title: '',
				sub_title: '',
				status: '',
				start_date: '',
				firstClass: '',
				secClass: '',
				lastClass: ''
			}
		}
  },

  computed: {
    isEmpty () {
			const requiedFields = ['sub_title', 'status', 'firstClass']

			if (this.form.status !== 1) {
				requiedFields.push('start_date')
			}

			return requiedFields
				.map(field => this.form[field])
				.some(v => v === '')
		},

		lastClassOptions () {
			return this.options.lastClass[this.form.secClass]
		}
  },

  created () {
    if (this.isEdit) {
      this.getPushs()
		}
		this.getPushsOptions()
  },

  mounted () {

		this.$nextTick(() => {

			$('#datepicker_start').datetimepicker({
				format: "yyyy/mm/dd hh:ii",
				autoclose: true,
				startDate: new Date()
			});

			$('#datepicker_start').on('changeDate', () => {
				this.form.start_date = $('#datepicker_start').datetimepicker('getFormattedDate')
			});

    })

  },

	updated () {
		$('.my-select').selectpicker();
		$('.selectpicker').selectpicker('refresh');
	},

  methods: {
    getPushs () {
      const uri = `/api/pushs/${this.id}/edit`
      axios.get(uri)
      .then(res => {
				const {
					title,
					sub_title,
					status,
					start_date,
					url  } = res.data.push

				console.log(JSON.parse(url))

				const { firstClass, secClass, lastClass } = JSON.parse(url)

				$('#firstClass').val(firstClass);
				$('#secClass').val(secClass);
				$('#lastClass').val(lastClass);

				this.form = {
					...this.form,
					title,
					sub_title,
					status,
					start_date: status === 1 ? '' : start_date,
					firstClass,
					secClass,
					lastClass
				}

      })
		},

		getPushsOptions () {
			const uri = `/api/pushs/options`
      axios.get(uri)
      .then(res => {
				const { firstClass, secClass, lastClass } = res.data

				this.options.firstClass = firstClass
				this.options.secClass = secClass
				this.options.lastClass = lastClass

				$('.my-select').selectpicker();
			})
		},

    handleResetDate (field) {
      this.form[field] = ''
    },

    handleCreate () {
			this.isSubmitting = true

			const submitForm = {
				...this.form
			}

			if (submitForm.status === 1) {
				submitForm.start_date = format(new Date(), 'yyyy-MM-dd')
			}

      const uri = `/api/pushs`
      axios.post(uri, {
        ...submitForm
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '新增成功'})
          .then(() => {
            location.assign(location.origin + '/pushs')
          })
      })
    },

    handleSave () {

			this.isSubmitting = true

			const submitForm = {
				...this.form
			}

			if (submitForm.status === 1) {
				submitForm.start_date = format(new Date(), 'yyyy-MM-dd')
			}

      const uri = `/api/pushs/${this.id}`
      axios.put(uri, {
        ...submitForm
      })
      .then(() => {
        Swal.fire({
          timer: 6000,
          title: '儲存變更'})
          .then(() => {
            location.assign(location.origin + '/pushs')
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
            location.assign(location.origin + '/pushs')
          }
        })
    },

    deleteConfirm () {
      return new Promise((resolve, reject) => {
        Swal.fire({
          title: `確定要刪除嗎？若刪除此推播將無法回復。`,
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
          const uri = `/api/pushs/${this.id}`
          axios.delete(uri)
          .then(() => {
            Swal.fire({
              title: '推播已刪除'
            })
            .then(() => {
              location.assign(location.origin + '/pushs')
            })
          })
        })
		},

		handleSecClass () {
			$('#lastClass').selectpicker();
		},

		handleStatus () {
			if (this.form.status === 1) {
				this.form.start_date = ''
			}
		}
  }
}
</script>

<style>

.bootstrap-select .inner {
	overflow-y: auto !important;
}

</style>