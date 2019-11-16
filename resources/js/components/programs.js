require('../bootstrap');

import program from '../../components/programs/program'
import programForm from '../../components/programs/programForm'

new Vue({
	el: '#programs',
	components: {
		program,
		programForm
	}
});