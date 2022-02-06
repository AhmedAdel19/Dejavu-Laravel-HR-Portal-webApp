import Axios from "axios"

export default {
    state: {
        userList:[],
        userMessages:[],
        
    },
    mutations: {
        userList(state , payload)
        {
            return state.userList = payload;
        },
        userMessages(state , payload)
        {
            return state.userMessages = payload;
        },
    },
    actions: {
        userList(context)
        {
            Axios.get('userList')
            .then(response => {
                context.commit('userList', response.data);
            })
        },

        userMessages(context , payload)
        {
            Axios.get('userMessages/'+payload)
            .then(response => {
                context.commit('userMessages', response.data);
            })
        }
    },
    getters: {
        userList(state){
            return state.userList;
        },
        userMessages(state)
        {
            return state.userMessages;
        }
    }
}