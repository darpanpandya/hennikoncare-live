"use strict";(self["webpackChunkoptinmonster_wordpress_plugin_vue_app"]=self["webpackChunkoptinmonster_wordpress_plugin_vue_app"]||[]).push([[594],{65194:function(t,e,a){a.r(e),a.d(e,{default:function(){return g}});var s=function(){var t=this,e=t._self._c;return e("core-page",[e("div",{staticClass:"omapi-about-us"},[e("common-tabnav",{attrs:{active:t.currentTab,tabs:t.allTabs},on:{go:t.goTo}}),e("common-alerts",{attrs:{id:"om-plugin-alerts",alerts:t.alerts}}),"about-us"===t.currentTab?e("about-us"):t._e(),"getting-started"===t.currentTab?e("about-getting-started"):t._e(),"lite-pro"===t.currentTab?e("about-lite-vs-pro"):t._e()],1)])},r=[],o=a(95353),u=a(45047),n={mixins:[u.v],data(){return{pageSlug:"about"}},computed:{...(0,o.aH)(["error","alerts"])}},i=n,l=a(81656),b=(0,l.A)(i,s,r,!1,null,null,null),g=b.exports},45047:function(t,e,a){a.d(e,{v:function(){return u}});var s=a(58156),r=a.n(s),o=a(95353);const u={computed:{...(0,o.L8)("tabs",["settingsTab","settingsTabs"]),allTabs(){return this.$store.getters[`tabs/${this.pageSlug}Tabs`]},currentTab(){return this.$store.getters[`tabs/${this.pageSlug}Tab`]},selectedTab(){return this.$get("$route.params.selectedTab")}},mounted(){this.goToSelected()},watch:{$route(t){this.goTo(r()(t,"params.selectedTab"))}},methods:{...(0,o.i0)("tabs",["goTab"]),navTo(t){this.goTab({page:this.pageSlug,tab:t,baseUrl:""})},goTo(t){this.goTab({page:this.pageSlug,tab:t})},goToSelected(){this.selectedTab&&this.goTo(this.selectedTab)}}}}}]);
//# sourceMappingURL=about.7931a7fb.js.map