import{_ as i}from"./AppLayout.8028b539.js";import o from"./DeleteTeamForm.e3346a3f.js";import{S as r}from"./SectionBorder.3b3400cf.js";import l from"./TeamMemberManager.ee482109.js";import n from"./UpdateTeamNameForm.1f86054c.js";import{o as a,c,w as s,a as m,b as t,d as p,F as d,e as f}from"./app.25506e31.js";import"./ResponsiveNavLink.841661c9.js";import"./Modal.a22afb5b.js";import"./SectionTitle.b29b4858.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./ConfirmationModal.bf815327.js";import"./DangerButton.94bdbad6.js";import"./SecondaryButton.bbbf3884.js";import"./ActionMessage.b9a95ff4.js";import"./DialogModal.2debcf98.js";import"./FormSection.d2be14ae.js";import"./TextInput.9855de7a.js";import"./InputLabel.9cd37758.js";import"./PrimaryButton.8ca1b39d.js";const u=m("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Team Settings ",-1),x={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},E={__name:"Show",props:{team:Object,availableRoles:Array,permissions:Object},setup(e){return(b,h)=>(a(),c(i,{title:"Team Settings"},{header:s(()=>[u]),default:s(()=>[m("div",null,[m("div",x,[t(n,{team:e.team,permissions:e.permissions},null,8,["team","permissions"]),t(l,{class:"mt-10 sm:mt-0",team:e.team,"available-roles":e.availableRoles,"user-permissions":e.permissions},null,8,["team","available-roles","user-permissions"]),e.permissions.canDeleteTeam&&!e.team.personal_team?(a(),p(d,{key:0},[t(r),t(o,{class:"mt-10 sm:mt-0",team:e.team},null,8,["team"])],64)):f("",!0)])])]),_:1}))}};export{E as default};