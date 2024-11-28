<template lang="">
    <div>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    data() {
        return {
            urls: {
                upload: '/api/post/upload/',
                postPatch: '/api/post/',
                postPost: '/api/post/',
                getPostBySlug: '/api/post/slug/',
                getCategoryAll: '/api/category/all'
            }
        }
    }
}
</script>

