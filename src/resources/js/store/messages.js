import {createStore} from "vuex";

export default  {
    state: () => ({
       messages: []
    }),

    namespaced: true,

    mutations: {
        addMessage(state, message, type) {
            state.messages.push(message);
        },

        clear(state) {
            state.messages = [];
        }
    },

    actions: {
        sendError({commit}, message) {
            commit('addMessage', {
                message,
                type: 'error'
            });
        },

        clearMessages({commit}) {
            commit('clear');
        }
    },

    getters: {
        errorMessages(state) {
            return state.messages.filter(m => m.type === 'error');
        }
    }
};
