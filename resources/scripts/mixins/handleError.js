const handleError = {
	data() {
		return {
			errors: [],
		}
	},
	methods: {
		hasError(field) {
			return this.errors?.[field]?.length > 0
		},
		getError(field) {
			return this.errors?.[field]?.[0]
		}
	}
}

export default handleError;
