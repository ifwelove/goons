<template>
  <div class="kt-pagination d-flex">
    <div class="kt-pagination__toolbar">
        <span class="pagination__desc">
            顯示第 {{ pagination.from }} 到 {{ pagination.to }} 項紀錄，總共 {{ pagination.total }} 項紀錄，每頁顯示
            <select
              class="form-control d-inline mr-0"
              style="width: 60px;"
              v-model="pagination.per_page"
              @change="handleSetPerpage"
            >
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            項紀錄
        </span>
    </div>

    <ul class="pagination mb-0">
      <li class="page-item"
        :class="{'disabled': pagination.current_page <= 1}"
        @click="handleSetPage(pagination.current_page - 1)">
        <a class="page-link" href="#" tabindex="-1">
          <i class="fa fa-chevron-left"></i>
        </a>
      </li>
      <li
        v-if="pagination.current_page > 1"
        class="page-item"
        @click="handleSetPage(pagination.current_page - 1)">
        <a class="page-link" href="#">{{ pagination.current_page - 1 }}</a>
        </li>
      <li class="page-item" >
        <a class="page-link" href="#">{{ pagination.current_page }}</a>
        </li>
      <li
        v-if="pagination.current_page < pagination.last_page"
        class="page-item"
        @click="handleSetPage(pagination.current_page + 1)">
        <a class="page-link" href="#">{{ pagination.current_page + 1 }}</a>
        </li>
      <li class="page-item"
        :class="{'disabled': pagination.current_page === pagination.last_page}"
        @click="handleSetPage(pagination.current_page + 1)">
        <a class="page-link" href="#">
          <i class="fa fa-chevron-right"></i>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
const queryString = require('query-string');

export default {
  props: {
    totalPages: {
      type: Number
    },
    pagination: {
      type: Object
    }
  },

  data () {
    return {
      perPages: 10
    }
  },

  computed: {
    fromPage () {
      retutn
    }
  },

  methods: {
    handleSetPage (page) {
      if (page < 1 || page > this.pagination.last_page) return

      const parsed = queryString.parse(location.search);
      parsed.page = page
      location.search = queryString.stringify(parsed);
    },

    handleSetPerpage () {
      const parsed = queryString.parse(location.search);
      parsed.page = 1
      parsed.perPage = this.pagination.per_page
      location.search = queryString.stringify(parsed);
    }
  }
}
</script>

<style>

</style>