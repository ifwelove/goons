require('../bootstrap');

import account from '../../components/accounts/account'
import accountForm from '../../components/accounts/accountForm'

new Vue({
	el: '#accounts',
	data: {
		account: ''
	},
	components: {
		account,
		accountForm
	}
});
