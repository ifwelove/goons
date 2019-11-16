<template>
<div class="container-fluid mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/programs">節目管理</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ isEdit ? '編輯' : '新增'}}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-12">
      <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right">
          <div class="kt-portlet__body">
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">節目名稱：</label>
              <div class="col-lg-6">
                 <select class="my-select selectpicker w-auto mr-2"
                  v-model="category">
                    <option value="空中崇拜">空中崇拜</option>
                    <option value="半邊天">半邊天</option>
                  </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">單集節目名稱：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限30個字" maxlength="30">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">主持人：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="限15個字" maxlength="15">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">音檔位址：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="http://">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">指定上架日期：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" id="datepicker_start" readonly="" placeholder="Select date"
                  v-model="startDate">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">指定下架日期：</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" id="datepicker_end" readonly="" placeholder="Select date"
                  v-model="endDate">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">單集簡介：</label>
              <div class="col-lg-6">
                <textarea class="form-control" placeholder="" maxlength="300"></textarea>
              </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-2">
                  <button v-if="isEdit" type="reset" class="btn btn-success">刪除</button>
                </div>
                <div class="col-10 text-right">
                  <button type="reset" class="btn btn-secondary">取消</button>
                  <template>
                    <button v-if="!isEdit" type="reset" class="btn btn-success" @click="handleCreate">新增</button>
                    <button v-else type="reset" class="btn btn-success" @click="handleSave">儲存</button>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div> <!-- end col -->
  </div>
</div><!-- container -->
</template>

<script>
export default {
  props: {
    isEdit: {
      type: Boolean
    }
  },

  data () {
    return {
      category: '空中崇拜',
      startDate: '',
      endDate: ''
    }
  },


  mounted () {
    this.$nextTick(() => {
      $('.my-select').selectpicker();
      $('#datepicker_start, #datepicker_end').datepicker({
        format: "yyyy/mm/dd"
      });
    })
  },


  methods: {
    handleCreate () {
      location.assign(location.origin + '/programs')
    },

    handleSave () {
      location.assign(location.origin + '/programs')
    }
  }

}
</script>

<style>

</style>