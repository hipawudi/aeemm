import{r as k,s as f,B as w,m as C,o as r,d as a,g as t,n as c,a as s,e as p,t as S,i as B,p as L,q as j,j as d,z as m,l as b,v as x,b as z,w as v,T as M,c as _,L as $}from"./app.c082a298.js";const D={class:"max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8"},E={class:"flex items-center justify-between flex-wrap"},N={class:"w-0 flex-1 flex items-center min-w-0"},V={key:0,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},R=s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),T=[R],q={key:1,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},A=s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"},null,-1),O=[A],P={class:"ml-3 font-medium text-sm text-white truncate"},U={class:"shrink-0 sm:ml-3"},F=s("svg",{class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1),G=[F],Q={__name:"Banner",setup(o){const n=k(!0),e=f(()=>{var l;return((l=w().props.value.jetstream.flash)==null?void 0:l.bannerStyle)||"success"}),i=f(()=>{var l;return((l=w().props.value.jetstream.flash)==null?void 0:l.banner)||""});return C(i,async()=>{n.value=!0}),(l,h)=>(r(),a("div",null,[n.value&&t(i)?(r(),a("div",{key:0,class:c({"bg-indigo-500":t(e)=="success","bg-red-700":t(e)=="danger"})},[s("div",D,[s("div",E,[s("div",N,[s("span",{class:c(["flex p-2 rounded-lg",{"bg-indigo-600":t(e)=="success","bg-red-600":t(e)=="danger"}])},[t(e)=="success"?(r(),a("svg",V,T)):p("",!0),t(e)=="danger"?(r(),a("svg",q,O)):p("",!0)],2),s("p",P,S(t(i)),1)]),s("div",U,[s("button",{type:"button",class:c(["-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition",{"hover:bg-indigo-600 focus:bg-indigo-600":t(e)=="success","hover:bg-red-600 focus:bg-red-600":t(e)=="danger"}]),"aria-label":"Dismiss",onClick:h[0]||(h[0]=B(g=>n.value=!1,["prevent"]))},G,2)])])])],2)):p("",!0)]))}},H={class:"relative"},W={__name:"Dropdown",props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:Array,default:()=>["py-1","bg-white"]}},setup(o){const n=o;let e=k(!1);const i=g=>{e.value&&g.key==="Escape"&&(e.value=!1)};L(()=>document.addEventListener("keydown",i)),j(()=>document.removeEventListener("keydown",i));const l=f(()=>({48:"w-48"})[n.width.toString()]),h=f(()=>n.align==="left"?"origin-top-left left-0":n.align==="right"?"origin-top-right right-0":"origin-top");return(g,u)=>(r(),a("div",H,[s("div",{onClick:u[0]||(u[0]=y=>m(e)?e.value=!t(e):e=!t(e))},[d(g.$slots,"trigger")]),b(s("div",{class:"fixed inset-0 z-40",onClick:u[1]||(u[1]=y=>m(e)?e.value=!1:e=!1)},null,512),[[x,t(e)]]),z(M,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:v(()=>[b(s("div",{class:c(["absolute z-50 mt-2 rounded-md shadow-lg",[t(l),t(h)]]),style:{display:"none"},onClick:u[2]||(u[2]=y=>m(e)?e.value=!1:e=!1)},[s("div",{class:c(["rounded-md ring-1 ring-black ring-opacity-5",o.contentClasses])},[d(g.$slots,"content")],2)],2),[[x,t(e)]])]),_:3})]))}},I={key:0,type:"submit",class:"block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"},J=["href"],X={__name:"DropdownLink",props:{href:String,as:String},setup(o){return(n,e)=>(r(),a("div",null,[o.as=="button"?(r(),a("button",I,[d(n.$slots,"default")])):o.as=="a"?(r(),a("a",{key:1,href:o.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"},[d(n.$slots,"default")],8,J)):(r(),_(t($),{key:2,href:o.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"},{default:v(()=>[d(n.$slots,"default")]),_:3},8,["href"]))]))}},Y={__name:"ResponsiveNavLink",props:{active:Boolean,href:String,as:String},setup(o){const n=o,e=f(()=>n.active?"block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition":"block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition");return(i,l)=>(r(),a("div",null,[o.as=="button"?(r(),a("button",{key:0,class:c([t(e),"w-full text-left"])},[d(i.$slots,"default")],2)):(r(),_(t($),{key:1,href:o.href,class:c(t(e))},{default:v(()=>[d(i.$slots,"default")]),_:3},8,["href","class"]))]))}};export{Q as _,X as a,W as b,Y as c};
