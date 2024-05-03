import{_ as p}from"./MembershipCard.46f42d86.js";import{_ as i}from"./MemberLayout.cd286b32.js";import{D as o,o as h,c as g,w as e,a as t,b as s,t as l,f as a}from"./app.25506e31.js";import"./ResponsiveNavLink.841661c9.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./VerifiedOutlined.e24dc8ca.js";import"./AppstoreOutlined.8da2a6ad.js";const f=t("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"\u6703\u54E1\u5C08\u5340",-1),x={class:"container mx-auto"},b={class:"flex flex-col-reverse md:flex-row gap-6"},v={class:"flex-auto md:w-1/2"},y={class:"container mx-auto pt-5"},w={class:"bg-white relative shadow rounded-lg pl-5"},k={class:"flex flex-col"},L={class:"text-center"},M={class:"w-20 text-center"},T=["innerHTML"],D={class:"flex-auto md:w-1/2"},H={class:"container mx-auto pt-5"},B={class:"bg-white relative shadow rounded-lg"},N=["innerHTML"],V=t("div",null,[t("h3",{class:"font-medium text-gray-900 text-left px-6"},"\u8FD1\u6CC1"),t("div",{class:"mt-5 w-full flex flex-col items-center overflow-hidden text-sm"},[t("a",{href:"#",class:"border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150"},[t("img",{src:"https://avatars0.githubusercontent.com/u/35900628?v=4",alt:"",class:"rounded-full h-6 shadow-md inline-block mr-2"}),a(" Updated his status "),t("span",{class:"text-gray-500 text-xs"},"24 min ago")]),t("a",{href:"#",class:"border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150"},[t("img",{src:"https://avatars0.githubusercontent.com/u/35900628?v=4",alt:"",class:"rounded-full h-6 shadow-md inline-block mr-2"}),a(" Added new profile picture "),t("span",{class:"text-gray-500 text-xs"},"42 min ago")]),t("a",{href:"#",class:"border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150"},[t("img",{src:"https://avatars0.githubusercontent.com/u/35900628?v=4",alt:"",class:"rounded-full h-6 shadow-md inline-block mr-2"}),a(" Posted new article in "),t("span",{class:"font-bold"},"#Web Dev"),t("span",{class:"text-gray-500 text-xs"},"49 min ago")]),t("a",{href:"#",class:"border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150"},[t("img",{src:"https://avatars0.githubusercontent.com/u/35900628?v=4",alt:"",class:"rounded-full h-6 shadow-md inline-block mr-2"}),a(" Edited website settings "),t("span",{class:"text-gray-500 text-xs"},"1 day ago")]),t("a",{href:"#",class:"border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150 overflow-hidden"},[t("img",{src:"https://avatars0.githubusercontent.com/u/35900628?v=4",alt:"",class:"rounded-full h-6 shadow-md inline-block mr-2"}),a(" Added new rank "),t("span",{class:"text-gray-500 text-xs"},"5 days ago")])])],-1),$={props:["member","messages"],components:{MemberLayout:i},data(){return{}},computed:{}},S=Object.assign($,{__name:"Dashboard",setup(d){return(n,j)=>{const c=o("a-avatar"),m=o("a-list-item-meta"),u=o("a-list-item"),_=o("a-list");return h(),g(i,{title:"\u6703\u54E1\u5C08\u5340"},{header:e(()=>[f]),default:e(()=>[t("div",x,[t("div",b,[t("div",v,[t("div",y,[t("div",w,[s(_,{"item-layout":"horizontal","data-source":d.messages},{renderItem:e(({item:r})=>[s(u,null,{default:e(()=>[s(m,null,{title:e(()=>[t("div",null,l(r.title),1)]),avatar:e(()=>[t("div",k,[t("div",L,[s(c,{src:"/images/logo.jpg"})]),t("div",M,l(r.send_date),1)])]),description:e(()=>[t("div",{innerHTML:r.content},null,8,T)]),_:2},1024)]),_:2},1024)]),_:1},8,["data-source"])])])]),t("div",D,[t("div",H,[t("div",B,[s(p,{card:n.$page.props.user.member},{description:e(()=>[t("div",{innerHTML:n.card.description},null,8,N)]),_:1},8,["card"]),V])])])])])]),_:1})}}});export{S as default};