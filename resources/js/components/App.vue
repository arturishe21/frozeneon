<template>
    <div>
        <headerPage></headerPage>
        <contentPage></contentPage>
    </div>
</template>

<script>

    import headerPage from './partials/Header';
    import ContentPage from './partials/Content';

    export default {
        components: {
            headerPage,
            ContentPage
        },
    }
</script>