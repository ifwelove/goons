require('../bootstrap');

import news from '../../components/news/news'
import newsForm from '../../components/news/newsForm'

new Vue({
	el: '#news',
	components: {
		news,
		newsForm
	}
});