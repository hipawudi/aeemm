import{_ as i}from"./AppLayout.248290b3.js";import o from"./DeleteTeamForm.4e8f0355.js";import{S as r}from"./SectionBorder.723ce95c.js";import l from"./TeamMemberManager.9e13021f.js";import n from"./UpdateTeamNameForm.cfb31e77.js";import{o as a,c,w as s,a as m,b as t,d as p,F as d,e as f}from"./app.505072c8.js";import"./ResponsiveNavLink.840dcc6e.js";import"./NavLink.bf645c54.js";import"./Modal.0fc8ad28.js";import"./SectionTitle.5bcf0f02.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./ConfirmationModal.ea0570a7.js";import"./DangerButton.f8ada59c.js";import"./SecondaryButton.407926cb.js";import"./ActionMessage.a094b2c4.js";import"./DialogModal.1969d0ed.js";import"./FormSection.ea44a9a2.js";import"./TextInput.aa90bb0e.js";import"./InputLabel.afbb63ab.js";import"./PrimaryButton.fa6106a6.js";const u=m("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Team Settings ",-1),x={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},q={__name:"Show",props:{team:Object,availableRoles:Array,permissions:Object},setup(e){return(b,h)=>(a(),c(i,{title:"Team Settings"},{header:s(()=>[u]),default:s(()=>[m("div",null,[m("div",x,[t(n,{team:e.team,permissions:e.permissions},null,8,["team","permissions"]),t(l,{class:"mt-10 sm:mt-0",team:e.team,"available-roles":e.availableRoles,"user-permissions":e.permissions},null,8,["team","available-roles","user-permissions"]),e.permissions.canDeleteTeam&&!e.team.personal_team?(a(),p(d,{key:0},[t(r),t(o,{class:"mt-10 sm:mt-0",team:e.team},null,8,["team"])],64)):f("",!0)])])]),_:1}))}};export{q as default};