<template>
    <inertia-head>
        <title>Login</title>
    </inertia-head>
    <div class="h-screen w-screen bg-slate-100 flex items-center justify-center">
        <div class="max-w-sm w-full p-4">
            <h1 class="text-lg font-bold text-center">Laravel Antd Pro</h1>
            <p class="text-slate-500 text-base text-center mb-12">Welcome to Laravel Antd Pro</p>
            <a-form>
                <a-form-item name="email">
                    <a-input
                        :placeholder="Email"
                        v-model:value="form.email"
                        size="large"
                    >
                        <template #prefix>
                            <UserOutlined/>
                        </template>
                    </a-input>
                </a-form-item>

                <a-form-item name="password">
                    <a-input-password :placeholder="Password" size="large" v-model:value="form.password"
                                      @keydown.enter="login">
                        >
                        <template #prefix>
                            <LockOutlined/>
                        </template>
                    </a-input-password>
                </a-form-item>

                <a-form-item>
                    <a-checkbox name="remember" v-model:checked="form.remember">Remember Me</a-checkbox>

                    <!--                    <inertia-link :href="route('password.request')" class="float-right">Forget Password?</inertia-link>-->
                </a-form-item>

                <a-form-item>
                    <a-button @click="login" block type="primary" size="large">Login</a-button>
                </a-form-item>
            </a-form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    setup() {
        const rules = {
            email: [
                {required: true, message: '请输入邮箱'},
                {type: 'email', message: '请输入正确的邮箱'}
            ],
            password: [
                {required: true, message: '请输入密码'}
            ]
        }

        return { rules }
    },
    data () {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },
    methods: {
        login () {
            this.form.post('/login?ref=admin')
        }
    }
}
</script>