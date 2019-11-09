<template>
	<div class="kt-pagination d-flex">
		<div class="kt-pagination__toolbar">
				<span class="pagination__desc">
						顯示第 1 到 10 項紀錄，總共 {{ totalPages }} 項紀錄，每頁顯示
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
			<li class="page-item"><a class="page-link" href="#">1</a></li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
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
		currentPage: {
			type: Number
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

	}
}
</script>

<style>

</style>