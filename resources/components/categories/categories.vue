<template>
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet kt-portlet--height-fluid-half mt-4">
                <div class="kt-portlet__body">
                    <div class="kt-portlet__content">
                      <div class="d-flex">
                        <div class="kt-input-icon kt-input-icon--right w-auto mr-2">
													<input type="text" class="form-control" placeholder="搜尋節目名稱、主持人" id="generalSearch"
														v-model="keyword">
													<span class="kt-input-icon__icon kt-input-icon__icon--right">
														<span><i class="fa fa-search"></i></span>
													</span>
												</div>
                        <button type="button" class="btn btn-primary mr-2"
                        @click="handleSearch">查詢</button>
												<button type="button" class="btn btn-primary"
                        @click="handleSearchReset">清除</button>
                      </div>
                    </div>
                </div>
            </div>

            <div class="page-title-box bg-none">
                <div class="page-title-right">
                    <button type="button" class="btn btn-primary"
                      @click="handleAddPrograms">新增節目</button>
                </div>
                <h2 class="page-title">節目列表</h2>
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
                        <table class="table table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>節目名稱</th>
                                <th>代表圖</th>
                                <th>主持人</th>
                                <th>排序</th>
                                <th>狀態</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                              <tr v-for="programItem in programsList" :key="programItem.id">
                                <td>{{ programItem.id }}</td>
                                <td>{{ programItem.title }}</td>
                                <td>
																	<img :src="programItem.image" alt="" style="width: 100px; height: 100px; object-fit: cover;">
																</td>
                                <td>{{ programItem.anchor }}</td>
                                <td>
																	<div class="btn-group" role="group" aria-label="Basic example">
																		<button type="button" class="btn btn-secondary"
                                      @click="handleSort(programItem, 'top')">置頂</button>
																		<button type="button" class="btn btn-secondary"
                                      @click="handleSort(programItem, 'sub')">
																			<i class="fas fa-arrow-up"></i>
																		</button>
																		<button type="button" class="btn btn-secondary"
                                      @click="handleSort(programItem, 'add')">
																			<i class="fas fa-arrow-down"></i>
																		</button>
																		<button type="button" class="btn btn-secondary"
                                      @click="handleSort(programItem, 'down')">置底</button>
																	</div>
																</td>
																<td>
                                  <span class="kt-switch">
                                    <label style="margin-bottom: 0">
                                    <input
                                      type="checkbox"
                                      :checked="programItem.status"
                                      name=""
                                      @click="handleToggleStatus(programItem)">
                                    <span style="padding: 4px;"></span>
                                    </label>
                                  </span>
                                </td>
                                <td>
                                  <button type="button" class="btn btn-light btn-circle btn-icon"
                                    @click="handleEdit(programItem.id)">
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
      >
    </Pagination>

  </div><!-- container -->
</template>

<script>
import axios from 'axios'
const queryString = require('query-string');
import Pagination from '../Pagination'

// const programsList = [
//   {
//     id: 1,
// 		title: '書香園地',
// 		subtitle: '書香園地',
// 		image_url: 'http://placekitten.com/200/300',
//     host: '方華',
//     is_published: true,
//   },
//   {
//     id: 2,
// 		title: '齊來頌揚',
// 		subtitle: '齊來頌揚',
// 		image_url: 'http://placekitten.com/200/300',
//     host: '方立心、章讚',
//     is_published: false,
//   },
// ]

export default {

  components: {
    Pagination
  },

  data () {
    return {
      keyword: '',
      currentPage: 1,
      pagination: {
        from: null,
        to: null,
        total: null,
        per_page: null,
        current_page: 1
      },
      programsList: [],
      category: '空中崇拜'
    }
  },

  created () {
    this.init()
    this.getProgramsList()
  },

  mounted () {

  },

  methods: {
    init () {
      const parsed = queryString.parse(location.search);
      this.keyword = parsed.keyword
    },

    getProgramsList () {
      const search = location.search
      const uri = `/api/categories${search}`
      axios.get(uri)
      .then((res) => {
        const { data } = res
        this.programsList = data.data.sort((a, b) => a.sort - b.sort)
        const {
          from,
          to,
          total,
          per_page,
          last_page,
          current_page
        } = data

        this.pagination = {
          from, to, total, per_page, current_page, last_page
        }
      })
    },

    handleEdit (id) {
      location.assign(location.href + `/${id}/edit`)
    },

    handleSearch () {
      const parsed = queryString.parse(location.search);
      parsed.page = 1
      parsed.keyword = this.keyword
      location.search = queryString.stringify(parsed);

      this.getProgramsList()
    },

		handleSearchReset () {
      const parsed = queryString.parse(location.search);
      parsed.page = 1
      parsed.keyword = ''
      location.search = queryString.stringify(parsed);

      this.getProgramsList()
    },

    handleAddPrograms () {
      location.assign(location.href + '/create')
    },

    handleToggleStatus (programItem) {
      const toggleStatus = programItem.status ? 0 : 1

      const uri = `/api/categories/${programItem.id}/status`
      axios.put(uri, {
        status: toggleStatus
      })
      .then((res) => {
      })
    },

    handleSort (programItem, type) {
      const uri = `/api/categories/${programItem.id}/top/sort`
      axios.put(uri, {
        type
      })
      .then((res) => {
        this.getProgramsList()
      })
    }
  }

}
</script>

<style scoped>
.table td {
  vertical-align: middle;
}
</style>