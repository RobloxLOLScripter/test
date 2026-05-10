package com.trixx1.stretchres;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import net.fabricmc.loader.api.FabricLoader;

import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.util.ArrayList;
import java.util.List;

public class StretchConfig {
    public static final File CONFIG_DIR = FabricLoader.getInstance().getConfigDir().resolve("stretchres").toFile();
    private static final Gson GSON = new GsonBuilder().setPrettyPrinting().create();

    public static Profile currentProfile = new Profile();
    public static List<String> availableProfiles = new ArrayList<>();
    public static String currentProfileName = "default";

    private static class Global {
        public String lastProfile = "default";
    }

    public static class Profile {
        public double stretchFactor = 1.0;
        public boolean noHandSwing = false;
        public boolean hideHand = false;
        public double swingSpeed = 1.0;
        public double swingSmoothness = 1.0;
        public boolean oldSwing = false;
        public double viewmodelX = 0.0;
        public double viewmodelY = 0.0;
        public double viewmodelZ = 0.0;
        public double viewmodelScale = 1.0;
        public double viewmodelPitch = 0.0;
        public double viewmodelYaw = 0.0;
        public double viewmodelRoll = 0.0;
    }

    public static void init() {
        if (!CONFIG_DIR.exists()) CONFIG_DIR.mkdirs();
        updateProfileList();

        File globalFile = new File(CONFIG_DIR, "global.json");
        String toLoad = "default";
        if (globalFile.exists()) {
            try (FileReader reader = new FileReader(globalFile)) {
                Global global = GSON.fromJson(reader, Global.class);
                if (global != null) toLoad = global.lastProfile;
            } catch (Exception ignored) {}
        }
        loadProfile(toLoad);
    }

    public static void updateProfileList() {
        availableProfiles.clear();
        File[] files = CONFIG_DIR.listFiles((dir, name) -> name.endsWith(".json") && !name.equals("global.json"));
        if (files != null) {
            for (File file : files) {
                availableProfiles.add(file.getName().replace(".json", ""));
            }
        }
        if (!availableProfiles.contains("default")) availableProfiles.add("default");
    }

    public static void saveProfile(String name) {
        try (FileWriter writer = new FileWriter(new File(CONFIG_DIR, name + ".json"))) {
            GSON.toJson(currentProfile, writer);
            if (!availableProfiles.contains(name)) availableProfiles.add(name);
            currentProfileName = name;

            Global global = new Global();
            global.lastProfile = name;
            try (FileWriter gWriter = new FileWriter(new File(CONFIG_DIR, "global.json"))) {
                GSON.toJson(global, gWriter);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public static void loadProfile(String name) {
        File file = new File(CONFIG_DIR, name + ".json");
        if (file.exists()) {
            try (FileReader reader = new FileReader(file)) {
                Profile loaded = GSON.fromJson(reader, Profile.class);
                if (loaded != null) {
                    currentProfile = loaded;
                    currentProfileName = name;
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        } else {
            currentProfile = new Profile();
            currentProfileName = name;
            saveProfile(name);
        }
    }
}
