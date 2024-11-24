import{Q as x,T as k,l as c,c as l,b as s,a as r,u as t,e as n,w as m,i as V,E as _,g as p,B as b,f as h,o as u,j as w}from"./app-DQs3gJAQ.js";import{_ as g}from"./InputError-C9Jnqp-y.js";import{a as y,_ as v}from"./TextInput-BXOJdlo8.js";import{P as B}from"./PrimaryButton-S4iFM_oU.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const S={key:0},E={class:"text-sm mt-2 text-gray-800 dark:text-gray-200"},N={class:"mt-2 font-medium text-sm text-green-600 dark:text-green-400"},P={class:"flex items-center gap-4"},U={key:0,class:"text-sm text-gray-600 dark:text-gray-400"},j={__name:"UpdateProfileInformationForm",props:{mustVerifyEmail:{type:Boolean},status:{type:String}},setup(d){const o=x().props.auth.user,a=k({name:o.name,email:o.email});return c(null),c(o.profile_picture||""),(f,e)=>(u(),l("section",null,[e[6]||(e[6]=s("header",null,[s("h2",{class:"text-lg font-medium text-gray-900 dark:text-gray-100"},"Profile Information"),s("p",{class:"mt-1 text-sm text-gray-600 dark:text-gray-400"}," Update your account's profile information and email address. ")],-1)),s("form",{onSubmit:e[2]||(e[2]=h(i=>t(a).patch(f.route("profile.update")),["prevent"])),class:"mt-6 space-y-6"},[s("div",null,[r(v,{for:"name",value:"Name"}),r(y,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:t(a).name,"onUpdate:modelValue":e[0]||(e[0]=i=>t(a).name=i),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),r(g,{class:"mt-2",message:t(a).errors.name},null,8,["message"])]),s("div",null,[r(v,{for:"email",value:"Email"}),r(y,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:t(a).email,"onUpdate:modelValue":e[1]||(e[1]=i=>t(a).email=i),required:"",autocomplete:"username"},null,8,["modelValue"]),r(g,{class:"mt-2",message:t(a).errors.email},null,8,["message"])]),d.mustVerifyEmail&&t(o).email_verified_at===null?(u(),l("div",S,[s("p",E,[e[4]||(e[4]=n(" Your email address is unverified. ")),r(t(w),{href:f.route("verification.send"),method:"post",as:"button",class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:m(()=>e[3]||(e[3]=[n(" Click here to re-send the verification email. ")])),_:1},8,["href"])]),V(s("div",N," A new verification link has been sent to your email address. ",512),[[_,d.status==="verification-link-sent"]])])):p("",!0),s("div",P,[r(B,{disabled:t(a).processing},{default:m(()=>e[5]||(e[5]=[n("Save")])),_:1},8,["disabled"]),r(b,{"enter-active-class":"transition ease-in-out","enter-from-class":"opacity-0","leave-active-class":"transition ease-in-out","leave-to-class":"opacity-0"},{default:m(()=>[t(a).recentlySuccessful?(u(),l("p",U,"Saved.")):p("",!0)]),_:1})])],32)]))}};export{j as default};
