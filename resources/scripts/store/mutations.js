import * as types from './mutation-types'

export default {
	[types.UPDATE_APP_LOADING_STATUS]: (state, data) => {
		state.isAppLoaded = data
	},
	[types.SET_INITIAL_DATA]: (state, data) => {

		state.shop = data.shop;
		state.billing_plan = data.plan;
		state.billing_plans = data.plans.sort((planA, planB) => parseFloat(planA.price) - parseFloat(planB.price));
		state.features = data.features.sort((featureA, featureB) => parseInt(featureA.display_order) - parseInt(featureB.display_order));
		state.bootstrapped = true;
	},
}
