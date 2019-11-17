require('../bootstrap');

import pushes from '../../components/pushes/pushes'
import pushesForm from '../../components/pushes/pushesForm'

new Vue({
	el: '#pushes',
	components: {
		pushes,
		pushesForm
	}
});