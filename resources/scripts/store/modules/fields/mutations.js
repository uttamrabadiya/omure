import * as types from './mutation-types'

export default {
	[types.FIELDS](state, data) {
		state.fields = data.fields;
        state.field_types = data.field_types;
    }
}
