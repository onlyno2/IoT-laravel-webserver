<template>
  <CContainer class="d-flex content-center min-vh-100">
    <CRow>
      <CCol>
        <CCardGroup>
          <CCard class="p-4">
            <CCardBody>
              <CForm>
                <h1>Login</h1>
                <p class="text-muted">Sign In to your account</p>
                <CInput
                  placeholder="Username"
                  autocomplete="username email"
                  v-model="username"
                >
                  <template #prepend-content><CIcon name="cil-user"/></template>
                </CInput>
                <CInput
                  placeholder="Password"
                  type="password"
                  autocomplete="curent-password"
                  v-model="password"
                >
                  <template #prepend-content
                    ><CIcon name="cil-lock-locked"
                  /></template>
                </CInput>
                <CRow>
                  <CCol col="6" class="text-left">
                    <CButton color="primary" class="px-4" @click="login"
                      >Login</CButton
                    >
                  </CCol>
                  <CCol col="6" class="text-right">
                    <CButton color="link" class="px-0"
                      >Forgot password?</CButton
                    >
                  </CCol>
                </CRow>
              </CForm>
            </CCardBody>
          </CCard>
        </CCardGroup>
      </CCol>
    </CRow>
  </CContainer>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      username: "",
      password: ""
    };
  },
  methods: {
    login() {
      console.log(this.username, this.password);
      axios
        .post("/api/auth/login", {
          name: this.username,
          password: this.password
        })
        .then(response => {
          console.log(response.data);
          this.$cookies.set(
            "Token",
            "Bearer " + response.data.access_token,
            response.data.expires_in
          );
          this.$router.push("/dashboard");
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
