require('../bootstrap');

import categories from '../../components/categories/categories'
import categoriesForm from '../../components/categories/categoriesForm'

new Vue({
	el: '#categories',
	components: {
		categories,
		categoriesForm
	}
});