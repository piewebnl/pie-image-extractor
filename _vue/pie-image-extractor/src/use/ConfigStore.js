import { ref } from 'vue'

const baseUrl = ref("");

export function useConfigStore() {

	if (process.env.NODE_ENV === "development") {
		baseUrl.value = "http://wordpress-test.test";
	}

	return {
		baseUrl
	}

}


