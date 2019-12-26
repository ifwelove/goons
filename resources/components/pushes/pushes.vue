<template>
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet kt-portlet--height-fluid-half mt-4">
                <div class="kt-portlet__body">
                    <div class="kt-portlet__content">
                      <div class="d-flex">

                        <div class="input-group date w-auto mr-2">
                          <input type="text"
                            class="form-control"
														id="datepicker"
                            placeholder="請選擇日期"
                          />
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <i class="fa fa-calendar-alt glyphicon-th"></i>
                            </span>
                          </div>
                        </div>

												<div class="kt-input-icon kt-input-icon--right w-auto mr-2">
													<input type="text" class="form-control" placeholder="搜尋標題、消息內容" id="generalSearch"
														v-model="filters.keyword">
													<span class="kt-input-icon__icon kt-input-icon__icon--right">
														<span><i class="fa fa-search"></i></span>
													</span>
												</div>

												<select class="my-select selectpicker w-auto mr-2"
                          title="狀態"
                          v-model="filters.status">
													<option
														v-for="(item, index) in status"
														:key="item"
														:value="index"
														>{{ item }}
													</option>
												</select>

												<div class="flex text-right" style="flex: 1">
													<button type="button" class="btn btn-primary mr-2"
														@click="handleSearch">查詢
													</button>
													<button type="button" class="btn btn-primary"
														@click="handleResetSearch">清除
													</button>
												</div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="page-title-box bg-none">
                <div class="page-title-right">
                    <button
                      type="button" class="btn btn-primary"
                      @click="handleAddnews">新增推播</button>
                </div>
                <h2 class="page-title">推播列表</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-body">
                    <h5 class="header-title"></h5>
                    <p class="sub-header"></p>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0" style="word-break: break-all;">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>狀態</th>
                                <th>推播時間</th>
                                <th>標題</th>
                                <th style="width: 30%;">推播內容</th>
                                <th>跳轉位址</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                              <tr v-for="pushesItem in pushes" :key="pushesItem.id">
                                <td>{{ pushesItem.id }}</td>
                                <td>
                                  <span v-if="pushesItem.status == '1'" class="badge badge-pill badge-success">已發佈</span>
                                  <span v-if="pushesItem.status == '0'" class="badge badge-pill badge-primary">預約中</span>
                                </td>
                                <td>{{ formatDate(pushesItem.start_date) }}</td>
                                <td style="width: 10%">
																	<div class="truncate-two-line">{{ pushesItem.title }}</div>
                                <td style="width: 30%">
																	<div class="truncate-two-line" v-html="pushesItem.sub_title"></div>
																</td>
                                <td>
																	<div>{{ pushesItem.first_class }}</div>
																	<div>{{ pushesItem.sec_class }}</div>
																	<div>{{ pushesItem.last_class }}</div>
																</td>
                                <td>
																	<button
																		v-if="Number(pushesItem.status) == 0"
																		type="button" class="btn btn-light btn-circle btn-icon"
																		@click="handleEdit(pushesItem.id)">
																		<i class="fa fa-pen"></i>
																	</button>
																	<button
																		v-else
																		type="button" class="btn btn-primary"
                                    @click="handleOpenRecord(pushesItem.id)">
                                    推播紀錄
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>

    <Pagination
      class="mt-5"
      :pagination="pagination"
      @setPerPage="setPerPage"
      @setPage="setPage"
      >
    </Pagination>

  </div><!-- container -->
</template>

<script>
import format from 'date-fns/format'
import twLocale from 'date-fns/locale/zh-TW'
import Pagination from '../Pagination'

export default {

  components: {
    Pagination
  },

  data () {
    return {
			pushes: [],
      status: [],
      filters: {
				status: '',
				keyword: '',
        page: '',
        perPage: '',
        start_date: ''
      },
      pagination: {
        from: null,
        to: null,
        total: null,
        per_page: null,
        current_page: 1
      },
    }
  },

  created () {
    this.getPushes(true)
  },

  updated () {
    $('.my-select').selectpicker('refresh');
  },

  mounted () {
    $('#datepicker').datepicker({
			format: "yyyy/mm/dd",
			autoclose: true
		}).on('changeDate', e => {
      this.filters.start_date = format(new Date(e.date), 'yyyy-MM-dd')
    });

  },

  methods: {
    formatDate (date) {
      return format(new Date(date), 'yyyy/MM/dd (eeeee) hh:mm', { locale: twLocale })
    },

    getPushes (isFirst= false) {
      const params = {
				...this.filters
      }

      const uri = `/api/pushs`
      axios.get(uri, {
        params
      })
      .then((res) => {
				const { data } = res
				if (isFirst) {
					this.status = data.status
				}

				this.pushes = data.pushs.data

        const {
          from,
          to,
          total,
          per_page,
          last_page,
          current_page
        } = data.pushs

        this.pagination = {
          from, to, total, per_page, current_page, last_page
        }
      })

    },

    handleEdit (id) {
      location.assign(location.origin + `/pushs/${id}/edit`)
		},

		handleOpenRecord (id) {

			const push = this.pushes.find(e => e.id == id)

			Swal.fire({
				html:
          `
          <div style="text-align: left">
            <div style="margin-bottom: 16px;">
              <div>標題：</div>
              <div>${push.title}</div>
            </div>

            <div style="margin-bottom: 16px;">
              <div>推播時間：</div>
              <div>${format(new Date(push.start_date), 'yyyy/MM/dd hh:mm')}
                <span class="badge badge-pill badge-success" style="margin-left: 12px;">${Number(push.status) === 1 ? '已發佈' : '預約中'}</span>
              </div>
            </div>

            <div style="margin-bottom: 16px;">
              <div>跳轉位址：</div>
              <div>${push.first_class}</div>
              <div>${push.sec_class}</div>
              <div>${push.last_class}</div>
            </div>

            <div style="margin-bottom: 16px;">
              <div>推播內容：</div>
              <div>${push.sub_title}</div>
            </div>
          </div>`,
        confirmButtonText: '返回'
      })
		},

    handleSearch () {
      this.getPushes()
      this.filters.page = 1
		},

		handleResetSearch () {
      this.filters = {
        status: '',
				keyword: '',
        page: '',
        perPage: '',
        start_date: ''
      }

      $('#datepicker').datepicker('update', '');
      this.getPushes()
		},

    handleAddnews () {
      location.assign(location.origin + `/pushs/create`)
    },

    setPerPage (perPage) {
      this.filters.perPage = perPage
      this.filters.page = 1
      this.getPushes()
    },

    setPage (page) {
      this.filters.page = page
      this.getPrograms()
    }
  }

}
</script>

<style scoped>
.table td {
  vertical-align: middle;
}

.truncate-two-line {
	display: block;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
	text-overflow: ellipsis;
}
</style>
