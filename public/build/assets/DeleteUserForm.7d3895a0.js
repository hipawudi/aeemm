import{r as d,u as _,o as y,c as w,w as e,f as s,a as c,b as t,g as a,O as h,n as v}from"./app.d569b791.js";import{_ as g}from"./Modal.8e42d813.js";import{_ as m}from"./DangerButton.a22bd882.js";import{_ as k}from"./DialogModal.042d9b49.js";import{_ as x,a as C}from"./TextInput.2976aba3.js";import{_ as D}from"./SecondaryButton.b51aee0c.js";import"./SectionTitle.16818296.js";import"./_plugin-vue_export-helper.cdc0426e.js";const b=c("div",{class:"max-w-xl text-sm text-gray-600"}," Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. ",-1),V={class:"mt-5"},$={class:"mt-4"},T={__name:"DeleteUserForm",setup(A){const r=d(!1),l=d(null),o=_({password:""}),p=()=>{r.value=!0,setTimeout(()=>l.value.focus(),250)},u=()=>{o.delete(route("current-user.destroy"),{preserveScroll:!0,onSuccess:()=>n(),onError:()=>l.value.focus(),onFinish:()=>o.reset()})},n=()=>{r.value=!1,o.reset()};return(U,i)=>(y(),w(g,null,{title:e(()=>[s(" Delete Account ")]),description:e(()=>[s(" Permanently delete your account. ")]),content:e(()=>[b,c("div",V,[t(m,{onClick:p},{default:e(()=>[s(" Delete Account ")]),_:1})]),t(k,{show:r.value,onClose:n},{title:e(()=>[s(" Delete Account ")]),content:e(()=>[s(" Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account. "),c("div",$,[t(x,{ref_key:"passwordInput",ref:l,modelValue:a(o).password,"onUpdate:modelValue":i[0]||(i[0]=f=>a(o).password=f),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",onKeyup:h(u,["enter"])},null,8,["modelValue","onKeyup"]),t(C,{message:a(o).errors.password,class:"mt-2"},null,8,["message"])])]),footer:e(()=>[t(D,{onClick:n},{default:e(()=>[s(" Cancel ")]),_:1}),t(m,{class:v(["ml-3",{"opacity-25":a(o).processing}]),disabled:a(o).processing,onClick:u},{default:e(()=>[s(" Delete Account ")]),_:1},8,["class","disabled"])]),_:1},8,["show"])]),_:1}))}};export{T as default};