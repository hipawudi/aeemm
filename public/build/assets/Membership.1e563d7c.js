import{_ as m}from"./MemberLayout.d0485647.js";import{_ as l}from"./MembershipCard.a0abbb1c.js";import{_ as p}from"./_plugin-vue_export-helper.cdc0426e.js";import{D as o,o as a,c as s,w as t,f as _,t as h,a as e,d as f,h as u,F as g}from"./app.7f364e3c.js";import"./ResponsiveNavLink.a9b53671.js";import"./AppstoreOutlined.bae1f559.js";const b={components:{MemberLayout:m,MembershipCard:l},props:["certificates"],data(){return{cardHolder:[{organization:"\u6FB3\u9580\u67D4\u9053\u5354\u6703\u6703\u54E1",title:"\u88C1\u5224\u8CC7\u683C\u8A8D\u8B49",name:"\u8B1D\u5EE3\u6F22",number:"0001",rank_caption:"\u6BB5\u6578",rank:"1",face:"/images/card1.png",description:"\u6FB3\u9580\u67D4\u9053\u7E3D\u6703\u88C1\u5224\u8CC7\u683C\u8A8D\u8B49<br><ul><li>aaa</li></ul>"},{organization:"\u6FB3\u9580\u67D4\u9053\u5354\u6703\u6559\u7DF4\u54E1",title:"\u6559\u5B98\u8CC7\u683C\u8A8D\u8B49",name:"\u8B1D\u5EE3\u6F22",number:"0012",rank_caption:"\u7D1A\u5225",rank:"1",face:"/images/card2.png",description:"aaaaaaaaaaaaaaa"}]}},created(){this.cardHolder=this.certificates,this.cardHolder[0].face="/images/card1.png"},methods:{}},x=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"\u6703\u7C4D",-1),M={class:"py-12"},k={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},v={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg"},w=["innerHTML"];function y(i,C,H,L,n,$){const c=o("MembershipCard"),d=o("MemberLayout");return a(),s(d,{title:"Dashboard"},{header:t(()=>[x]),default:t(()=>[_(" "+h(i.member)+" ",1),e("div",M,[e("div",k,[e("div",v,[(a(!0),f(g,null,u(n.cardHolder,r=>(a(),s(c,{title:"Professional Certificate",card:r},{description:t(()=>[e("div",{innerHTML:r.description},null,8,w)]),_:2},1032,["card"]))),256))])])])]),_:1})}const V=p(b,[["render",y]]);export{V as default};
