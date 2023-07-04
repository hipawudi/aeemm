import{_ as p}from"./AppLayout.545f1498.js";import c from"./DeleteUserForm.d28dff6a.js";import l from"./LogoutOtherBrowserSessionsForm.6093416c.js";import{S as s}from"./SectionBorder.5ae83072.js";import f from"./TwoFactorAuthenticationForm.2e387a32.js";import u from"./UpdatePasswordForm.05d85b06.js";import d from"./UpdateProfileInformationForm.803c96fb.js";import{o as e,c as _,w as n,a as i,d as r,b as t,e as a,F as h}from"./app.7f364e3c.js";import"./ResponsiveNavLink.a9b53671.js";import"./NavLink.81a1e84f.js";import"./Modal.464a6685.js";import"./SectionTitle.f84408c0.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./DangerButton.19012bdb.js";import"./DialogModal.ac73ecca.js";import"./TextInput.2c0eb1d0.js";import"./SecondaryButton.be463e97.js";import"./ActionMessage.3008bcae.js";import"./PrimaryButton.4152bcde.js";import"./InputLabel.ec85b98d.js";import"./FormSection.b80f89ba.js";const g=i("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1),$={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},w={key:0},k={key:1},y={key:2},J={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(o,x)=>(e(),_(p,{title:"Profile"},{header:n(()=>[g]),default:n(()=>[i("div",null,[i("div",$,[o.$page.props.jetstream.canUpdateProfileInformation?(e(),r("div",w,[t(d,{user:o.$page.props.user},null,8,["user"]),t(s)])):a("",!0),o.$page.props.jetstream.canUpdatePassword?(e(),r("div",k,[t(u,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),o.$page.props.jetstream.canManageTwoFactorAuthentication?(e(),r("div",y,[t(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(l,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),o.$page.props.jetstream.hasAccountDeletionFeatures?(e(),r(h,{key:3},[t(s),t(c,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{J as default};