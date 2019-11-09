<template>
<div class="container-fluid mt-5">
	<div class="row">
		<div class="col-12">
			<div class="kt-portlet">
				<!--begin::Form-->
				<form class="kt-form kt-form--label-right">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">姓名:</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" placeholder="限中英數字">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">帳號:</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" placeholder="限英數字">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">密碼:</label>
							<div class="col-lg-6">
								<input type="password" class="form-control" placeholder="6-12位英數字密碼">
							</div>
						</div>
						<div class="form-group row">
								<label class="col-lg-3 col-form-label">權限管理:</label>
								<div class="col-lg-6 kt-checkbox-list mt-2 pl-2">
									<label class="kt-checkbox">
												<input type="checkbox"> 帳號管理
												<span></span>
										</label>
										<label class="kt-checkbox">
												<input type="checkbox"> 節目分類
												<span></span>
										</label>
										<label class="kt-checkbox">
												<input type="checkbox"> 節目內容
												<span></span>
										</label>
										<label class="kt-checkbox">
												<input type="checkbox"> 最新消息
												<span></span>
										</label>
										<label class="kt-checkbox">
												<input type="checkbox"> 推播管理
												<span></span>
										</label>
								</div>
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2">
								</div>
								<div class="col-10 text-right">
									<button type="reset" class="btn btn-secondary">取消</button>
									<button type="reset" class="btn btn-success">新增</button>
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

}
</script>

<style>

</style>