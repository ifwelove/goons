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
                          v-model="keyword">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right">
                          <span><i class="fa fa-search"></i></span>
                        </span>
                      </div>
                      <button type="button" class="btn btn-primary"
                        @click="handleSearch">查詢</button>
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
                                <td>{{ account.account }}</td>
                                <td>
                                  <span class="kt-switch">
                                    <label style="margin-bottom: 0">
                                    <input type="checkbox" :checked="account.is_active" name="">
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
      :currentPage="currentPage"
      :totalPage="accounts.length"
      >
    </Pagination>

  </div><!-- container -->
</template>

<script>
import Pagination from './Pagination'
export default {

  components: {
    Pagination
  },

  data () {
    return {
      keyword: '',
      currentPage: 1,
      accounts: []
    }
  },

  created () {
    // call api

    this.accounts = [
      {
        id: 1,
        name: 'David',
        account: 'abc123',
        is_active: true
      },
      {
        id: 2,
        name: '王小凱',
        account: 'abc1234',
        is_active: false
      }
    ]



  },

  methods: {
    handleEdit (id) {
      location.assign(location.href + `/${id}/edit`)
    },

    handleSearch () {
      console.log('handleSearch', this.keyword)
    },

    handleAddAccount () {
      location.assign(location.href + '/create')
    }
  }

}
</script>

<style scoped>
.table td {
  vertical-align: middle;
}
</style>