<template>
<v-app>
   <Header></Header>
   <Search></Search>
   <Footer></Footer>
</v-app>
</template>


<script>
import Header from './Header'
import Search from './Search'
import Footer from './Footer'

export default{
  name: 'app-index',
  components: {
    Header,
    Search,
    Footer
  }
}
</script>