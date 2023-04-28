import{r as p,G as E,o as t,d as s,a as l,j as H,b as a,w as o,f as n,t as C,N as B,n as x,P as I,u as Q,s as Y,m as D,c as y,g as h,e as u,F as G,h as U,B as j,k as A}from"./app.c082a298.js";import{_ as z}from"./Modal.6167383e.js";import{_ as O}from"./DialogModal.bc8492b2.js";import{_ as R,a as L}from"./TextInput.123e7f73.js";import{_ as $}from"./PrimaryButton.511b571b.js";import{_ as S}from"./SecondaryButton.fdae2863.js";import{_ as W}from"./DangerButton.cec91f2d.js";import{_ as J}from"./InputLabel.2bcdadde.js";import"./SectionTitle.e49e7c02.js";import"./_plugin-vue_export-helper.cdc0426e.js";const X={class:"mt-4"},w={__name:"ConfirmsPassword",props:{title:{type:String,default:"Confirm Password"},content:{type:String,default:"For your security, please confirm your password to continue."},button:{type:String,default:"Confirm"}},emits:["confirmed"],setup(g,{emit:b}){const c=p(!1),e=E({password:"",error:"",processing:!1}),i=p(null),v=()=>{axios.get(route("password.confirmation")).then(r=>{r.data.confirmed?b("confirmed"):(c.value=!0,setTimeout(()=>i.value.focus(),250))})},_=()=>{e.processing=!0,axios.post(route("password.confirm"),{password:e.password}).then(()=>{e.processing=!1,d(),I().then(()=>b("confirmed"))}).catch(r=>{e.processing=!1,e.error=r.response.data.errors.password[0],i.value.focus()})},d=()=>{c.value=!1,e.password="",e.error=""};return(r,m)=>(t(),s("span",null,[l("span",{onClick:v},[H(r.$slots,"default")]),a(O,{show:c.value,onClose:d},{title:o(()=>[n(C(g.title),1)]),content:o(()=>[n(C(g.content)+" ",1),l("div",X,[a(R,{ref_key:"passwordInput",ref:i,modelValue:e.password,"onUpdate:modelValue":m[0]||(m[0]=T=>e.password=T),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",onKeyup:B(_,["enter"])},null,8,["modelValue","onKeyup"]),a(L,{message:e.error,class:"mt-2"},null,8,["message"])])]),footer:o(()=>[a(S,{onClick:d},{default:o(()=>[n(" Cancel ")]),_:1}),a($,{class:x(["ml-3",{"opacity-25":e.processing}]),disabled:e.processing,onClick:_},{default:o(()=>[n(C(g.button),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}},Z={key:0,class:"text-lg font-medium text-gray-900"},ee={key:1,class:"text-lg font-medium text-gray-900"},te={key:2,class:"text-lg font-medium text-gray-900"},oe=l("div",{class:"mt-3 max-w-xl text-sm text-gray-600"},[l("p",null," When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application. ")],-1),se={key:3},ae={key:0},ne={class:"mt-4 max-w-xl text-sm text-gray-600"},re={key:0,class:"font-semibold"},le={key:1},ce=["innerHTML"],ie={key:0,class:"mt-4 max-w-xl text-sm text-gray-600"},ue={class:"font-semibold"},de=["innerHTML"],me={key:1,class:"mt-4"},fe={key:1},pe=l("div",{class:"mt-4 max-w-xl text-sm text-gray-600"},[l("p",{class:"font-semibold"}," Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost. ")],-1),_e={class:"grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg"},he={class:"mt-5"},ve={key:0},ye={key:1},Pe={__name:"TwoFactorAuthenticationForm",props:{requiresConfirmation:Boolean},setup(g){const b=g,c=p(!1),e=p(!1),i=p(!1),v=p(null),_=p(null),d=p([]),r=Q({code:""}),m=Y(()=>{var f;return!c.value&&((f=j().props.value.user)==null?void 0:f.two_factor_enabled)});D(m,()=>{m.value||(r.reset(),r.clearErrors())});const T=()=>{c.value=!0,A.Inertia.post("/user/two-factor-authentication",{},{preserveScroll:!0,onSuccess:()=>Promise.all([M(),N(),F()]),onFinish:()=>{c.value=!1,e.value=b.requiresConfirmation}})},M=()=>axios.get("/user/two-factor-qr-code").then(f=>{v.value=f.data.svg}),N=()=>axios.get("/user/two-factor-secret-key").then(f=>{_.value=f.data.secretKey}),F=()=>axios.get("/user/two-factor-recovery-codes").then(f=>{d.value=f.data}),P=()=>{r.post("/user/confirmed-two-factor-authentication",{errorBag:"confirmTwoFactorAuthentication",preserveScroll:!0,preserveState:!0,onSuccess:()=>{e.value=!1,v.value=null,_.value=null}})},q=()=>{axios.post("/user/two-factor-recovery-codes").then(()=>F())},V=()=>{i.value=!0,A.Inertia.delete("/user/two-factor-authentication",{preserveScroll:!0,onSuccess:()=>{i.value=!1,e.value=!1}})};return(f,K)=>(t(),y(z,null,{title:o(()=>[n(" Two Factor Authentication ")]),description:o(()=>[n(" Add additional security to your account using two factor authentication. ")]),content:o(()=>[h(m)&&!e.value?(t(),s("h3",Z," You have enabled two factor authentication. ")):h(m)&&e.value?(t(),s("h3",ee," Finish enabling two factor authentication. ")):(t(),s("h3",te," You have not enabled two factor authentication. ")),oe,h(m)?(t(),s("div",se,[v.value?(t(),s("div",ae,[l("div",ne,[e.value?(t(),s("p",re," To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code. ")):(t(),s("p",le," Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application or enter the setup key. "))]),l("div",{class:"mt-4",innerHTML:v.value},null,8,ce),_.value?(t(),s("div",ie,[l("p",ue,[n(" Setup Key: "),l("span",{innerHTML:_.value},null,8,de)])])):u("",!0),e.value?(t(),s("div",me,[a(J,{for:"code",value:"Code"}),a(R,{id:"code",modelValue:h(r).code,"onUpdate:modelValue":K[0]||(K[0]=k=>h(r).code=k),type:"text",name:"code",class:"block mt-1 w-1/2",inputmode:"numeric",autofocus:"",autocomplete:"one-time-code",onKeyup:B(P,["enter"])},null,8,["modelValue","onKeyup"]),a(L,{message:h(r).errors.code,class:"mt-2"},null,8,["message"])])):u("",!0)])):u("",!0),d.value.length>0&&!e.value?(t(),s("div",fe,[pe,l("div",_e,[(t(!0),s(G,null,U(d.value,k=>(t(),s("div",{key:k},C(k),1))),128))])])):u("",!0)])):u("",!0),l("div",he,[h(m)?(t(),s("div",ye,[a(w,{onConfirmed:P},{default:o(()=>[e.value?(t(),y($,{key:0,type:"button",class:x(["mr-3",{"opacity-25":c.value}]),disabled:c.value},{default:o(()=>[n(" Confirm ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),a(w,{onConfirmed:q},{default:o(()=>[d.value.length>0&&!e.value?(t(),y(S,{key:0,class:"mr-3"},{default:o(()=>[n(" Regenerate Recovery Codes ")]),_:1})):u("",!0)]),_:1}),a(w,{onConfirmed:F},{default:o(()=>[d.value.length===0&&!e.value?(t(),y(S,{key:0,class:"mr-3"},{default:o(()=>[n(" Show Recovery Codes ")]),_:1})):u("",!0)]),_:1}),a(w,{onConfirmed:V},{default:o(()=>[e.value?(t(),y(S,{key:0,class:x({"opacity-25":i.value}),disabled:i.value},{default:o(()=>[n(" Cancel ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),a(w,{onConfirmed:V},{default:o(()=>[e.value?u("",!0):(t(),y(W,{key:0,class:x({"opacity-25":i.value}),disabled:i.value},{default:o(()=>[n(" Disable ")]),_:1},8,["class","disabled"]))]),_:1})])):(t(),s("div",ve,[a(w,{onConfirmed:T},{default:o(()=>[a($,{type:"button",class:x({"opacity-25":c.value}),disabled:c.value},{default:o(()=>[n(" Enable ")]),_:1},8,["class","disabled"])]),_:1})]))])]),_:1}))}};export{Pe as default};
