<template>
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet kt-portlet--height-fluid-half mt-4">
                <div class="kt-portlet__body">
                    <div class="kt-portlet__content">
                      <div class="d-flex">
                        <select class="my-select selectpicker w-auto mr-2"
                          title="請選擇節目類別"
                          v-model="category"
                          @change="isShowList = false">
                            <option
                              v-for="categoryItem in categories"
                              :key="categoryItem.id"
                              :value="categoryItem.id">{{ categoryItem.title }}</option>
                          </select>
                        <button type="button" class="btn btn-primary"
                        @click="handleSearch">顯示列表</button>
                      </div>
                    </div>
                </div>
            </div>

            <div class="page-title-box bg-none">
                <div class="page-title-right">
                    <button
                      v-if="isShowList"
                      type="button" class="btn btn-primary"
                      @click="handleAddPrograms">新增節目</button>
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
                                <th>單集節目名稱</th>
                                <th>主持人</th>
                                <th>音檔位址</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody v-if="isShowList">
                              <tr v-for="program in programs" :key="program.id">
                                <td>{{ program.id }}</td>
                                <td>
                                  <span class="badge badge-pill badge-primary">{{ program.status }}</span>
                                  <!-- <span class="badge badge-pill badge-primary">Primary</span> -->
                                  <!-- <span class="badge badge-pill badge-primary">Primary</span> -->
                                </td>
                                <td>{{ formatDate(program.start_date) }}</td>
                                <td>{{ formatDate(program.end_date) }}</td>
                                <td>{{ program.title }}</td>
                                <td>{{ program.anchor }}</td>
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
      v-if="isShowList"
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
      programs: [],
      categories: [],
      category: null,
      isShowList: false,
      filters: {
        page: '',
        perPage: ''
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
      },
    }
  },

  created () {
    this.getPrograms(true)
  },

  methods: {
    formatDate (date) {
      return format(new Date(date), 'yyyy/MM/dd (eeeee) hh:mm', { locale: twLocale })
    },

    getPrograms (isFirst= false) {
      const params = {
        category: this.category,
        ...{page: this.filters.page || ''},
        ...{perPage: this.filters.perPage || ''},
        ...this.sort
      }

      const uri = `/api/programs`
      axios.get(uri, {
        params
      })
      .then((res) => {
        const { data } = res
        this.categories = data.categories.filter(category => category.status === 1)

        if (!isFirst) {
          this.programs = data.programs.data
        }

        $('.my-select').selectpicker();

        const {
          from,
          to,
          total,
          per_page,
          last_page,
          current_page
        } = data.programs

        this.pagination = {
          from, to, total, per_page, current_page, last_page
        }
      })

    },

    handleEdit (id) {
      location.assign(location.origin + `/programs/${id}/edit?category=${this.category}`)
    },

    handleSearch () {
      this.getPrograms()
      this.isShowList = true
      this.filters.page = 1
    },

    handleAddPrograms () {
      location.assign(location.origin + `/programs/create?category=${this.category}`)
    },

    setPerPage (perPage) {
      this.filters.perPage = perPage
      this.getPrograms()
    },

    setPage (page) {
      this.filters.page = page
      this.getPrograms()
    },

    handleSort (field) {
      if (this.sort.column === field) {
        this.sort.sort = this.sort.sort === 'asc' ? 'desc' : 'asc'
      } else {
        this.sort.sort = 'asc'
      }
      this.sort.column = field
      this.getPrograms()
    },
  }

}
</script>

<style scoped>
.table td {
  vertical-align: middle;
}
</style>