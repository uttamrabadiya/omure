import * as types from './mutation-types'

export const loadDashboardData = ({commit, dispatch, state}, params) => {
	return new Promise((resolve, reject) => {
		axios.get(`/api/dashboard`, {params}).then((response) => {
			commit(types.SET_INITIAL_DATA, response.data)
			commit(types.GET_INITIAL_DATA, true)
			resolve(response)
		}).catch((err) => {
			commit(types.GET_INITIAL_DATA, true)
			reject(err)
		})
	})
}

export const loadUpcomingFeatures = ({commit, dispatch, state}, params) => {
	return new Promise((resolve, reject) => {
		axios.get(`/api/dashboard/upcoming-features`, {params}).then((response) => {
			commit(types.SET_UPCOMING_FEATURES, response.data)
			resolve(response)
		}).catch((err) => {
			reject(err)
		})
	})
}

export const loadStates = ({commit, dispatch, state}, params) => {
	return new Promise((resolve, reject) => {
		axios.get(`/api/dashboard/states`, {params}).then((response) => {
			commit(types.STATES, response.data)
			resolve(response)
		}).catch((err) => {
			reject(err)
		})
	})
}

export const loadRevenueData = ({commit, dispatch, state}, params) => {
	return new Promise((resolve, reject) => {
		axios.get(`/api/dashboard/revenue`, {params}).then((response) => {
			commit(types.REVENUE_DATA, response.data)
			resolve(response)
		}).catch((err) => {
			reject(err)
		})
	})
}

export const loadSubscriptionData = ({commit, dispatch, state}, params) => {
	return new Promise((resolve, reject) => {
		axios.get(`/api/dashboard/subscriptions`, {params}).then((response) => {
			commit(types.SUBSCRIPTION_DATA, response.data)
			resolve(response)
		}).catch((err) => {
			reject(err)
		})
	})
}

export const setHelpPopupDate = ({commit, dispatch, state}, params) => {
	return new Promise((resolve, reject) => {
		axios.post(`/api/dashboard/trigger-help-popup`,).then((response) => {
			resolve(response)
		}).catch((err) => {
			reject(err)
		})
	})
}

export const getCustomerOfTheMonth = ({commit, dispatch, state}) => {
	return new Promise((resolve, reject) => {
		axios.post(`/api/dashboard/customer-of-month`,).then((response) => {
			resolve(response.data?.data)
		}).catch((err) => {
			reject(err)
		})
	})
}


export const getHighestOrderValue = ({commit, dispatch, state}) => {
	return new Promise((resolve, reject) => {
		axios.post(`/api/dashboard/highest-order-value?include=customer`,).then((response) => {
			resolve(response.data?.data)
		}).catch((err) => {
			reject(err)
		})
	})
}
