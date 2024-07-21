import {createStore} from "vuex";

export default  {
    state: () => ({
       messages: []
    }),

    namespaced: true,

    mutations: {
        addMessage(state, message, type) {
            state.messages.push({
                ...message,
                id: new Date().getTime() + '_' + message.type,
            });
        },

        clear(state) {
            state.messages = [];
        },

        deleteMessage(state, id) {
            state.messages = state.messages.filter(m => m.id !== id);
        }
    },

    actions: {
        sendError({commit}, message) {
            commit('addMessage', {
                message,
                type: 'error',
            });
        },

        clearMessages({commit}) {
            commit('clear');
        },

        removeMessage({commit}, id) {
            commit('deleteMessage', id);
        }
    },

    getters: {
        errorMessages(state) {
            return state.messages.filter(m => m.type === 'error');
        }
    }
};
