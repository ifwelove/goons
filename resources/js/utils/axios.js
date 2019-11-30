import axios from 'axios'

// Add a response interceptor
axios.interceptors.response.use(function (response) {
	// Any status code that lie within the range of 2xx cause this function to trigger
	// Do something with response data
	return response;
}, function (err) {
	console.log(err.response)
	const { message, message_format } = err.response.data

	Swal.fire({
		icon: 'error',
		title: message,
		html: message_format.map(e => e[0]).join('<br/>')
	})
	return Promise.reject(err);
});

export default axios