<template>
    <div>
        <button class="btn btn-primary ml-4" @click="followUser">
            {{ buttonText }}
        </button>
    </div>
</template>

<script>
import { EventBus } from '../utils/event-bus';

export default {
    name: 'follow-button',
    props: ['userId', 'follows'],

    data() {
        return {
            status: this.follows,
        };
    },

    mounted() {
        console.log('Component mounted.');
    },

    methods: {
        followUser() {
            axios
                .post('/follow/' + this.userId)
                .then(response => {
                    this.status = response.data.attached.length > 0;
                    EventBus.$emit(
                        'follow',
                        this.status ? 'follow' : 'unfollow',
                    );
                })
                .catch(errors => {
                    if (errors.response.status === 401) {
                        window.location = '/login';
                    }
                });
        },
    },

    computed: {
        buttonText() {
            return this.status ? 'Unfollow' : 'Follow';
        },
    },
};
</script>
