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
                            name="daterange"
                            v-model="daterange"
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
														v-model="filters.title">
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
                      @click="handleAddnews">新增消息</button>
                </div>
                <h2 class="page-title">最新消息列表</h2>
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
                                <th>上下架狀態</th>
                                <th style="cursor: pointer;"
                                  @click="handleSort('start_date')">
                                  上架日期
                                  <i class="fa fa-sort"></i>
                                </th>
                                <th style="cursor: pointer;"
                                  @click="handleSort('end_date')">
                                  下架日期
                                  <i class="fa fa-sort"></i>
                                </th>
                                <th>標題</th>
<!--                                <th style="width: 30%;">消息內容</th>-->
                                <th>自動推播</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                              <tr v-for="newsItem in news" :key="newsItem.id">
                                <td>{{ newsItem.id }}</td>
                                <td>
                                  <span v-if="newsItem.status === '預約中'" class="badge badge-pill badge-success">{{ newsItem.status }}</span>
                                  <span v-if="newsItem.status === '已上架'" class="badge badge-pill badge-primary">{{ newsItem.status }}</span>
                                  <span v-if="newsItem.status === '已下架'" class="badge badge-pill badge-warning">{{ newsItem.status }}</span>
                                </td>
                                <td>{{ formatDate(newsItem.start_date) }}</td>
                                <td>{{ formatDate(newsItem.end_date) }}</td>
                                <td style="width: 10%">
																	<div class="truncate-two-line">{{ newsItem.title }}</div>
<!--                                <td style="width: 30%">-->
<!--																	<div class="truncate-two-line" v-html="newsItem.description"></div>-->
<!--																</td>-->
                                <td>
																	<span v-if="newsItem.status === '已推播'"
																		class="badge badge-pill badge-primary">{{ newsItem.status }}</span>
																	<span v-else>{{ newsItem.push_status }}</span>
																</td>
                                <td>
                                  <button type="button" class="btn btn-light btn-circle btn-icon"
                                    @click="handleEdit(newsItem.id)">
                                    <i class="fa fa-pen"></i>
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
			news: [],
      status: [],
      daterange: null,
      filters: {
				status: '',
				title: '',
        page: '',
        perPage: '',
        start_date: '',
        end_date: ''
      },
      sort: {
        sort: '',
        column: ''
      },
      pagination: {
        from: null,
        to: null,
        total: null,
        per_page: null,
        current_page: 1
      }
    }
  },

  created () {
    this.getNews(true)
  },

  mounted () {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, (start, end, label) => {
      this.filters.start_date = start.format('YYYY/MM/DD')
      this.filters.end_date = end.format('YYYY/MM/DD')
      this.daterange = `${start.format('YYYY/MM/DD')}-${end.format('YYYY/MM/DD')}`
    });
  },

  methods: {
    formatDate (date) {
      return format(new Date(date), 'yyyy/MM/dd (eeeee) hh:mm', { locale: twLocale })
    },

    getNews (isFirst= false) {
      const params = {
        ...this.filters,
        ...this.sort
      }

      const uri = `/api/news`
      axios.get(uri, {
        params
      })
      .then((res) => {
				const { data } = res

				if (isFirst) {
					this.status = data.status
					$('.my-select').selectpicker();
				}

				this.news = data.news.data

        const {
          from,
          to,
          total,
          per_page,
          last_page,
          current_page
        } = data.news

        this.pagination = {
          from, to, total, per_page, current_page, last_page
        }
      })

    },

    handleEdit (id) {
      location.assign(location.origin + `/news/${id}/edit`)
    },

    handleSearch () {
      this.getNews()
      this.filters.page = 1
		},

		handleResetSearch () {
      this.filters = {
        status: '',
				title: '',
        page: '',
        perPage: '',
        start_date: '',
        end_date: ''
      }
      this.daterange = null

      $('.my-select').selectpicker('val', '');
      this.getNews()
    },

    handleSort (field) {
      if (this.sort.column === field) {
        this.sort.sort = this.sort.sort === 'asc' ? 'desc' : 'asc'
      } else {
        this.sort.sort = 'asc'
      }
      this.sort.column = field
      this.getNews()
    },

    handleAddnews () {
      location.assign(location.origin + `/news/create`)
    },

    setPerPage (perPage) {
      this.filters.perPage = perPage
      this.getNews()
    },

    setPage (page) {
      this.filters.page = page
      this.getNews()
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
