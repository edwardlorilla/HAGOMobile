<template>
    <div>
        <!-- Header -->
        <header id="portfolio">

            <div class="w3-container">
                <h1><b>Repositories of plants</b></h1>
                <div class="w3-section w3-padding-8">
                    <router-link class="w3-button w3-green"  to="repositories/create">Add Repositories</router-link>
                </div>

                <div class="w3-section w3-bottombar w3-padding-16">

                    <span class="w3-margin-right">Filter:</span>
                    <el-form>
                        <el-select v-model="distributions" multiple clearable placeholder="Filter Distributions">
                            <el-option
                                    v-for="item in pluckDistributions"
                                    :key="item"
                                    :label="item"
                                    :value="item">
                            </el-option>
                        </el-select>
                        <el-select v-model="categories" multiple clearable placeholder="Categories">
                            <el-option
                                    v-for="item in pluckCategories"
                                    :key="item"
                                    :label="item"
                                    :value="item">
                            </el-option>
                        </el-select>
                        <el-select v-model="families" multiple clearable placeholder="Families">
                            <el-option
                                    v-for="item in pluckFamilies"
                                    :key="item"
                                    :label="item"
                                    :value="item">
                            </el-option>
                        </el-select>
                    </el-form>

                    <!--<button class="w3-button w3-white"><i class="fa fa-diamond w3-margin-right"></i>Design</button>
                    <button class="w3-button w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos
                    </button>
                    <button class="w3-button w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art
                    </button>-->
                </div>
            </div>
        </header>

        <!-- First Photo Grid-->
        <div class="w3-row-padding" v-for="items in chunkItems">
            <div  v-for="(item, index) in items"  @click="editRepository(item)" :key="index" class="w3-third w3-container w3-margin-bottom">
                <img :src=" item.photos[0] ? 'images/thumb_' + item.photos[0].file : null" :alt="item.title"
                     style="width:100%" class="w3-hover-opacity">
                <div class="w3-container w3-white">
                    <p><b>{{item.title}}</b></p>
                    <p>{{item.description}}</p>
                </div>
            </div>
            <!--<div class="w3-third w3-container w3-margin-bottom">
                <img src="/w3images/lights.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
                <div class="w3-container w3-white">
                    <p><b>Lorem Ipsum</b></p>
                    <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae,
                        ultricies congue gravida diam non fringilla.</p>
                </div>
            </div>
            <div class="w3-third w3-container">
                <img src="/w3images/nature.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
                <div class="w3-container w3-white">
                    <p><b>Lorem Ipsum</b></p>
                    <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae,
                        ultricies congue gravida diam non fringilla.</p>
                </div>
            </div>-->
        </div>

        <!-- Pagination -->
        <div class="w3-center w3-padding-32">
            <div class="w3-bar">
                <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
                <a href="#" class="w3-bar-item w3-black w3-button">1</a>
                <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
                <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
                <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
                <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
            </div>
        </div>
    </div>
</template>
<style>
</style>
<script>
    import EditView from './edit.vue'
    import {changeRepository, editRepository}  from './../Ajax/getData'
    export default{
        methods:{
          editRepository(item){
              var vm = this
              editRepository(item)
              vm.$router.push({name: 'edit-repositories'})
          }
        },
        props: ['items'],
        components:{
            EditView
        },
        data(){
            return {
                changeRepository,
                distributions: [],
                categories: [],
                families: []
            }
        },
        computed: {
            selectedDistributions(){
                var vm = this
                var selectedDistributions;
                var distributions = vm.distributions
                var categories = vm.categories
                var families = vm.families
                var selectedFilter = _.filter(vm.items, function (select) {
                    return (select.distribution ? select.distribution.name ? distributions.indexOf(select.distribution.name) != -1 : select.distribution.name : null)
                        || (select.family ? select.family.name ? families.indexOf(select.family.name) != -1 : select.family.name : null)
                        || (select.category ? select.category.name ? categories.indexOf(select.category.name) != -1 : select.category.name : null)
                });

                if (_.isEmpty(distributions) && _.isEmpty(categories) &&_.isEmpty(families)) {
                    selectedDistributions = vm.items
                } else {
                    selectedDistributions = selectedFilter
                }
                return _.filter(selectedDistributions, function(select){
                  return select.published === 1
                })
            },
            pluckDistributions(){
                var distributions = this.items
                var map = _.map(distributions, function (num, key) {
                    return num.distribution ? num.distribution.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            }, pluckCategories(){
                var categories = this.items
                var map = _.map(categories, function (num, key) {
                    return num.category ? num.category.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            }, pluckFamilies(){
                var families = this.items
                var map = _.map(families, function (num, key) {
                    return num.family ? num.family.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            },
            chunkItems(){
                var vm = this;
                return _.chunk(vm.selectedDistributions, 3)
            },
            filterCategories(){
                var vm = this

            }

        }
    }
</script>
