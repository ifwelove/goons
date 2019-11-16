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
                <h2 class="page-title">節目單集列表</h2>
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
                                <th>上下架狀態</th>
                                <th>上架日期</th>
                                <th>下架日期</th>
                                <th>單集節目名稱</th>
                                <th>主持人</th>
                                <th>音檔位址</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                              <tr v-for="program in programs" :key="program.id">
                                <td>{{ program.id }}</td>
                                <td>
                                  <span class="kt-switch">
                                    <label style="margin-bottom: 0">
                                    <input type="checkbox" :checked="program.is_published" name="">
                                    <span style="padding: 4px;"></span>
                                    </label>
                                  </span>
                                </td>
                                <td>{{ program.published_time }}</td>
                                <td>{{ program.unpublished_time }}</td>
                                <td>{{ program.title }}</td>
                                <td>{{ program.host }}</td>
                                <td>{{ program.url }}</td>
                                <td>
                                  <button type="button" class="btn btn-light btn-circle btn-icon"
                                    @click="handleEdit(program.id)">
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
      :totalPage="programs.length"
      >
    </Pagination>

  </div><!-- container -->
</template>

<script>
import Pagination from '../Pagination'

const programs = [
  {
    id: 1,
    title: '我是生命的糧',
    host: '方華',
    url: 'http://',
    is_published: true,
    published_time: '2019/10/28(四) 06:00',
    unpublished_time: '2019/11/14(四) 23:59'
  },
  {
    id: 2,
    title: '你聽「道」後的回應為何',
    host: '方華',
    url: 'http://',
    is_published: false,
    published_time: '2019/10/28(四) 06:00',
    unpublished_time: '2019/11/14(四) 23:59'
  },
]

export default {

  components: {
    Pagination
  },

  data () {
    return {
      keyword: '',
      currentPage: 1,
      programs: []
    }
  },

  created () {
    // call api

    this.programs = programs
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