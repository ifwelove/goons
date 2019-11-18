<template>
  <div class="kt-pagination d-flex">
    <div class="kt-pagination__toolbar">
        <span class="pagination__desc">
            顯示第 {{ pagination.from }} 到 {{ pagination.to }} 項紀錄，總共 {{ pagination.total }} 項紀錄，每頁顯示
            <select
              class="form-control d-inline mr-0"
              style="width: 60px;"
              v-model="perPages"
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
      <li class="page-item disabled">
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
      <li class="page-item">
        <a class="page-link" href="#">{{ pagination.current_page }}</a>
        </li>
      <li class="page-item">
        <a class="page-link" href="#">{{ pagination.current_page + 1 }}</a>
        </li>
      <li class="page-item">
        <a class="page-link" href="#">
          <i class="fa fa-chevron-right"></i>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
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
      
    }
  }
}
</script>

<style>

</style>