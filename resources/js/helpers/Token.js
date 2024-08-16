class Token {
    isValid(token) {
        const payload = this.payload(token);
        let base_url = window.location.origin;
        return Boolean(payload && [base_url+"/api/auth/login",base_url+"/api/auth/refresh"].includes(payload.iss));
    }

    payload(token) {
        const payload = token.split('.')[1];
        return this.decode(payload);
    }

    decode(data) {
        return JSON.parse(atob(data))
    }
}

export default Token = new Token();
