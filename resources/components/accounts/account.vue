<template>
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet kt-portlet--height-fluid-half mt-4">
                <div class="kt-portlet__body">
                    <div class="kt-portlet__content">
                      <div class="d-flex">
                      <div class="kt-input-icon kt-input-icon--right w-auto mr-2">
                        <input type="text" class="form-control" placeholder="搜尋姓名、帳號" id="generalSearch"
                          v-model="filters.keyword">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right">
                          <span><i class="fa fa-search"></i></span>
                        </span>
                      </div>
                      <button type="button" class="btn btn-primary mr-2"
                        @click="handleSearch">查詢</button>
                      <button type="button" class="btn btn-primary"
                        @click="handleSearchReset">重置</button>
                      </div>
                    </div>
                </div>
            </div>

            <div class="page-title-box bg-none">
                <div class="page-title-right">
                    <button type="button" class="btn btn-primary"
                      @click="handleAddAccount">新增管理帳號</button>
                </div>
                <h2 class="page-title">帳號列表</h2>
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
                                <th>姓名</th>
                                <th>帳號</th>
                                <th>狀態</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                              <tr v-for="account in accounts" :key="account.id">
                                <td>{{ account.id }}</td>
                                <td>{{ account.name }}</td>
                                <td>{{ account.email }}</td>
                                <td>
                                  <span v-if="account.status == 1" class="kt-switch">
                                    <label style="margin-bottom: 0">
                                    <input
                                      type="checkbox"
                                      :name="account.id"
                                      checked
                                      @change="handleToggleStatus(account)">
                                    <span style="padding: 4px;"></span>
                                    </label>
                                  </span>
                                    <span v-else class="kt-switch">
                                    <label style="margin-bottom: 0">
                                    <input
                                            type="checkbox"
                                            :name="account.id"
                                            @change="handleToggleStatus(account)">
                                    <span style="padding: 4px;"></span>
                                    </label>
                                  </span>
                                </td>
                                <td>
                                  <button type="button" class="btn btn-light btn-circle btn-icon"
                                    @click="handleEdit(account.id)">
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
import Pagination from '../Pagination'
const queryString = require('query-string');

export default {

  components: {
    Pagination
  },

  data () {
    return {
      filters: {
        keyword: '',
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
      accounts: []
    }
  },

  created () {
    this.getAccounts()
  },

  methods: {

    getAccounts () {
      const uri = `/api/accounts`
      axios.get(uri, {
        params: {
          ...this.filters
        }
      })
      .then((res) => {
        const { data } = res
        this.accounts = data.data
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
      const account = this.accounts.find(account => account.id === id)
      this.$parent.account = account
      location.assign(location.origin + `/accounts/${id}/edit`)
    },

    handleSearch () {
      this.filters.page = 1
      this.getAccounts()
    },

    handleSearchReset () {
      this.filters = {
        page: 1,
        keyword: ''
      }
      this.getAccounts()
    },

    handleAddAccount () {
      location.assign(location.origin + '/accounts/create')
    },

    handleToggleStatus (account) {
      const toggleStatus = (account.status == 1) ? '0' : '1'
      const uri = `/api/accounts/${account.id}/status`
        _.map(this.accounts, function (item) {
            if (account.id == item.id) {
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

    setPerPage (perPage) {
      this.filters.perPage = perPage
      this.getAccounts()
    },

    setPage (page) {
      this.filters.page = page
      this.getAccounts()
    }
  }

}
</script>

<style scoped>
.table td {
  vertical-align: middle;
}
</style>
