import{r as M,o as r,d as n,b as o,g as w,H as C,a as e,w as s,L,f as a,c as p,t as h,F as m,e as i,h as k,i as f,n as g,j as x,k as $}from"./app.1e9c083a.js";import{_ as P,a as c,b as j,c as u}from"./ResponsiveNavLink.02afedd6.js";import{_}from"./NavLink.37949f26.js";const B={class:"min-h-screen bg-gray-100"},F={class:"bg-white border-b border-gray-100"},A={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},N={class:"flex justify-between h-16"},z={class:"flex"},D={class:"shrink-0 flex items-center"},I=e("img",{src:"/storage/aeemm_logo.jpg",style:{width:"64px"}},null,-1),V={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},O={class:"hidden sm:flex sm:items-center sm:ml-6"},H={class:"ml-3 relative"},E={class:"inline-flex rounded-md"},q={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"},G=e("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[e("path",{"fill-rule":"evenodd",d:"M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1),J={class:"w-60"},K=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1),Q=e("div",{class:"border-t border-gray-100"},null,-1),R=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1),U=["onSubmit"],W={class:"flex items-center"},X={key:0,class:"mr-2 h-5 w-5 text-green-400",fill:"none","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",stroke:"currentColor",viewBox:"0 0 24 24"},Y=e("path",{d:"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),Z=[Y],ee={class:"ml-3 relative"},te={key:0,class:"flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"},se=["src","alt"],re={key:1,class:"inline-flex rounded-md"},oe={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"},ae=e("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[e("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1),ne=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Account ",-1),ie=e("div",{class:"border-t border-gray-100"},null,-1),le=["onSubmit"],de={class:"-mr-2 flex items-center sm:hidden"},ue={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},he={class:"pt-2 pb-3 space-y-1"},ce={class:"pt-4 pb-1 border-t border-gray-200"},pe={class:"flex items-center px-4"},me={key:0,class:"shrink-0 mr-3"},fe=["src","alt"],_e={class:"font-medium text-base text-gray-800"},ge={class:"font-medium text-sm text-gray-500"},ve={class:"mt-3 space-y-1"},be=["onSubmit"],ye=e("div",{class:"border-t border-gray-200"},null,-1),we=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1),ke=e("div",{class:"border-t border-gray-200"},null,-1),xe=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1),$e=["onSubmit"],je={class:"flex items-center"},Te={key:0,class:"mr-2 h-5 w-5 text-green-400",fill:"none","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",stroke:"currentColor",viewBox:"0 0 24 24"},Se=e("path",{d:"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),Me=[Se],Ce={key:0,class:"bg-white shadow"},Le={class:"max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"},Ae={__name:"AppLayout",props:{title:String},setup(T){const d=M(!1),v=t=>{$.Inertia.put(route("current-team.update"),{team_id:t.id},{preserveState:!1})},b=()=>{$.Inertia.post(route("logout"))};return(t,y)=>(r(),n("div",null,[o(w(C),{title:T.title},null,8,["title"]),o(P),e("div",B,[e("nav",F,[e("div",A,[e("div",N,[e("div",z,[e("div",D,[o(w(L),{href:t.route("dashboard")},{default:s(()=>[I]),_:1},8,["href"])]),e("div",V,[o(_,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:s(()=>[a(" Dashboard ")]),_:1},8,["href","active"]),o(_,{href:t.route("professionals.index")},{default:s(()=>[a(" Professional ")]),_:1},8,["href"]),o(_,{href:t.route("membership")},{default:s(()=>[a(" Membership ")]),_:1},8,["href"]),o(_,{href:t.route("forms.index")},{default:s(()=>[a(" Forms ")]),_:1},8,["href"])])]),e("div",O,[e("div",H,[t.$page.props.jetstream.hasTeamFeatures?(r(),p(j,{key:0,align:"right",width:"60"},{trigger:s(()=>[e("span",E,[e("button",q,[a(h(t.$page.props.user.current_team.name)+" ",1),G])])]),content:s(()=>[e("div",J,[t.$page.props.jetstream.hasTeamFeatures?(r(),n(m,{key:0},[K,o(c,{href:t.route("teams.show",t.$page.props.user.current_team)},{default:s(()=>[a(" Team Settings ")]),_:1},8,["href"]),t.$page.props.jetstream.canCreateTeams?(r(),p(c,{key:0,href:t.route("teams.create")},{default:s(()=>[a(" Create New Team ")]),_:1},8,["href"])):i("",!0),Q,R,(r(!0),n(m,null,k(t.$page.props.user.all_teams,l=>(r(),n("form",{key:l.id,onSubmit:f(S=>v(l),["prevent"])},[o(c,{as:"button"},{default:s(()=>[e("div",W,[l.id==t.$page.props.user.current_team_id?(r(),n("svg",X,Z)):i("",!0),e("div",null,h(l.name),1)])]),_:2},1024)],40,U))),128))],64)):i("",!0)])]),_:1})):i("",!0)]),e("div",ee,[o(j,{align:"right",width:"48"},{trigger:s(()=>[t.$page.props.jetstream.managesProfilePhotos?(r(),n("button",te,[e("img",{class:"h-8 w-8 rounded-full object-cover",src:t.$page.props.user.profile_photo_url,alt:t.$page.props.user.name},null,8,se)])):(r(),n("span",re,[e("button",oe,[a(h(t.$page.props.user.name)+" ",1),ae])]))]),content:s(()=>[ne,o(c,{href:t.route("profile.show")},{default:s(()=>[a(" Profile ")]),_:1},8,["href"]),t.$page.props.jetstream.hasApiFeatures?(r(),p(c,{key:0,href:t.route("api-tokens.index")},{default:s(()=>[a(" API Tokens ")]),_:1},8,["href"])):i("",!0),ie,e("form",{onSubmit:f(b,["prevent"])},[o(c,{as:"button"},{default:s(()=>[a(" Log Out ")]),_:1})],40,le)]),_:1})])]),e("div",de,[e("button",{class:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition",onClick:y[0]||(y[0]=l=>d.value=!d.value)},[(r(),n("svg",ue,[e("path",{class:g({hidden:d.value,"inline-flex":!d.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),e("path",{class:g({hidden:!d.value,"inline-flex":d.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e("div",{class:g([{block:d.value,hidden:!d.value},"sm:hidden"])},[e("div",he,[o(u,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:s(()=>[a(" Dashboard ")]),_:1},8,["href","active"])]),e("div",ce,[e("div",pe,[t.$page.props.jetstream.managesProfilePhotos?(r(),n("div",me,[e("img",{class:"h-10 w-10 rounded-full object-cover",src:t.$page.props.user.profile_photo_url,alt:t.$page.props.user.name},null,8,fe)])):i("",!0),e("div",null,[e("div",_e,h(t.$page.props.user.name),1),e("div",ge,h(t.$page.props.user.email),1)])]),e("div",ve,[o(u,{href:t.route("profile.show"),active:t.route().current("profile.show")},{default:s(()=>[a(" Profile ")]),_:1},8,["href","active"]),t.$page.props.jetstream.hasApiFeatures?(r(),p(u,{key:0,href:t.route("api-tokens.index"),active:t.route().current("api-tokens.index")},{default:s(()=>[a(" API Tokens ")]),_:1},8,["href","active"])):i("",!0),e("form",{method:"POST",onSubmit:f(b,["prevent"])},[o(u,{as:"button"},{default:s(()=>[a(" Log Out ")]),_:1})],40,be),t.$page.props.jetstream.hasTeamFeatures?(r(),n(m,{key:1},[ye,we,o(u,{href:t.route("teams.show",t.$page.props.user.current_team),active:t.route().current("teams.show")},{default:s(()=>[a(" Team Settings ")]),_:1},8,["href","active"]),t.$page.props.jetstream.canCreateTeams?(r(),p(u,{key:0,href:t.route("teams.create"),active:t.route().current("teams.create")},{default:s(()=>[a(" Create New Team ")]),_:1},8,["href","active"])):i("",!0),ke,xe,(r(!0),n(m,null,k(t.$page.props.user.all_teams,l=>(r(),n("form",{key:l.id,onSubmit:f(S=>v(l),["prevent"])},[o(u,{as:"button"},{default:s(()=>[e("div",je,[l.id==t.$page.props.user.current_team_id?(r(),n("svg",Te,Me)):i("",!0),e("div",null,h(l.name),1)])]),_:2},1024)],40,$e))),128))],64)):i("",!0)])])],2)]),t.$slots.header?(r(),n("header",Ce,[e("div",Le,[x(t.$slots,"header")])])):i("",!0),e("main",null,[x(t.$slots,"default")])])]))}};export{Ae as _};