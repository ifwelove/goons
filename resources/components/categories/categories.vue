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
                                           v-model="filters.keyword">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
														<span><i class="fa fa-search"></i></span>
													</span>
                                </div>
                                <select class="form-control w-auto mr-2" id="exampleSelect1"
                                        v-model="filters.status">
                                    <option value="" disabled>狀態</option>
                                    <option value="1">上架</option>
                                    <option value="0">下架</option>
                                </select>
                                <!-- <select
                                  ref="statusSelect"
                                  class="my-select selectpicker w-auto mr-2"
                                  title="狀態"
                                  v-model="status">
                                  <option value="" disabled>狀態</option>
                                  <option value="1">上架</option>
                                  <option value="0">下架</option>
                                </select> -->
                                <button type="button" class="btn btn-primary mr-2"
                                        @click="handleSearch">查詢
                                </button>
                                <button type="button" class="btn btn-primary"
                                        @click="handleSearchReset">清除
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-title-box bg-none">
                    <div class="page-title-right">
                        <button type="button" class="btn btn-primary"
                                @click="handleAddPrograms">新增節目
                        </button>
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
                                    <td>{{ programItem.sort }}</td>
                                    <td>{{ programItem.title }}</td>
                                    <td>
                                        <img :src="programItem.image" alt=""
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    </td>
                                    <td>{{ programItem.anchor }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-secondary"
                                                    :disabled="isSearching || isTop(programItem)"
                                                    @click="handleSort(programItem, 'top')">置頂
                                            </button>
                                            <button type="button" class="btn btn-secondary"
                                                    :disabled="isSearching || isTop(programItem)"
                                                    @click="handleSort(programItem, 'add')">
                                                <i class="fas fa-arrow-up"></i>
                                            </button>
                                            <button type="button" class="btn btn-secondary"
                                                    :disabled="isSearching || isBottom(programItem)"
                                                    @click="handleSort(programItem, 'sub')">
                                                <i class="fas fa-arrow-down"></i>
                                            </button>
                                            <button type="button" class="btn btn-secondary"
                                                    :disabled="isSearching || isBottom(programItem)"
                                                    @click="handleSort(programItem, 'down')">置底
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                    <span v-if="programItem.status == 1"
                                          class="kt-switch">
                                    <label style="margin-bottom: 0">
                                    <input
                                            type="checkbox"
                                            :name="programItem.id"
                                            checked
                                            @click="handleToggleStatus(programItem)">
                                    <span style="padding: 4px;"></span>
                                    </label>
                                  </span>
                                        <span v-else class="kt-switch">
                                    <label style="margin-bottom: 0">
                                    <input
                                            type="checkbox"
                                            :name="programItem.id"
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
                @setPerPage="setPerPage"
                @setPage="setPage"
        >
        </Pagination>

    </div><!-- container -->
</template>

<script>
    import axios from 'axios'

    const queryString = require('query-string');
    import Pagination from '../Pagination'

    export default {
        components: {
            Pagination
        },

        data() {
            return {
                filters: {
                    keyword: '',
                    status: '',
                    page: '',
                    perPage: ''
                },
                pagination: {
                    from: null,
                    to: null,
                    total: null,
                    per_page: null,
                    current_page: 1
                },
                programsList: [],
                isSearching: false
            }
        },

        created() {
            this.getProgramsList()
        },

        methods: {
            getProgramsList() {
                const params = {
                    ...this.filters
                }

                const uri = `/api/categories`
                axios.get(uri, {
                    params
                })
                    .then((res) => {
                        const {data} = res
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

            handleEdit(id) {
                location.assign(location.origin + `/categories/${id}/edit`)
            },

            handleSearch() {
                this.isSearching = !!(this.filters.keyword || this.filters.status)
                this.filters.page = 1
                this.getProgramsList()
            },

            handleSearchReset() {
                this.filters = {
                    page: 1,
                    keyword: '',
                    status: ''
                }

                this.isSearching = false

                this.getProgramsList()
            },

            handleAddPrograms() {
                location.assign(location.origin + '/categories/create')
            },

            handleToggleStatus(programItem) {
                const toggleStatus = (programItem.status == 1) ? '0' : '1'
                const uri = `/api/categories/${programItem.id}/status`
                _.map(this.programsList, function (item) {
                    if (programItem.id == item.id) {
                        item.status = (item.status == 1) ? '0' : '1';
                    }

                    return item;
                });
                axios.put(uri, {
                    status: toggleStatus
                })
                    .then((res) => {
                    })
            },

            handleSort(programItem, type) {
                const uri = `/api/categories/${programItem.id}/${type}/sort`
                axios.put(uri)
                    .then((res) => {
                        this.getProgramsList()
                    })
            },

            setPerPage(perPage) {
                this.filters.perPage = perPage
                this.filters.page = 1
                this.getProgramsList()
            },

            setPage(page) {
                this.filters.page = page
                this.getProgramsList()
            },

            isTop(item) {
                return item.sort === 1
            },

            isBottom(item) {
                return item.sort === this.pagination.total
            }
        }

    }
</script>

<style scoped>
    .table td {
        vertical-align: middle;
    }
</style>
