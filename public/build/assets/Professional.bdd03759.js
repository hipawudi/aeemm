import{_ as l}from"./MemberLayout.cd286b32.js";import{_ as d}from"./_plugin-vue_export-helper.cdc0426e.js";import{D as n,o as s,c as _,w as a,a as t,d as c,h as m,F as f,t as o}from"./app.25506e31.js";import"./ResponsiveNavLink.841661c9.js";import"./VerifiedOutlined.e24dc8ca.js";import"./AppstoreOutlined.8da2a6ad.js";const p={components:{MemberLayout:l},props:["member","professionals"],data(){return{title:"",card:{}}},created(){},methods:{}},x=t("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"\u5C08\u696D\u8A8D\u8B49",-1),h={class:"py-12 h-full"},u={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},g={class:"flex flex-col md:flex-row gap-3"},v={class:"flex flex-col gap-3"},y={class:"text-lg font-bold"},b={class:""},w={class:"text-gray-500"};function k(B,L,r,$,M,C){const i=n("MemberLayout");return s(),_(i,{title:"\u5C08\u696D\u8A8D\u8B49",class:"overflow-hidden"},{header:a(()=>[x]),default:a(()=>[t("div",h,[t("div",u,[t("div",g,[(s(!0),c(f,null,m(r.professionals,e=>(s(),c("div",{key:e.id,class:"bg-white rounded-md w-full md:w-1/3 flex-initial p-4"},[t("div",v,[t("div",y,o(e.certificate.cert_title),1),t("div",b,o(e.certificate.cert_content),1),t("div",w,o(e.certificate.cert_body),1)])]))),128))])])])]),_:1})}const V=d(p,[["render",k]]);export{V as default};