import template from './sw-login-recovery-info.html.twig';

const { Component } = Shopware;

Component.register('sw-login-recovery-info', {
    template,

    computed: {
        rateLimitTime() {
            const waitTime = this.$route.params?.waitTime;
            if (typeof waitTime !== 'number') {
                return null;
            }

            return waitTime >= 1 ? waitTime : null;
        },
    },

    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.$emit('is-not-loading');
        },
    },
});
