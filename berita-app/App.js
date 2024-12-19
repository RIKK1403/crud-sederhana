import { useEffect, useState } from "react";
import { StyleSheet, Text, View, FlatList } from "react-native";
import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";
import { NavigationContainer } from "@react-navigation/native";
import Icon from "react-native-vector-icons/MaterialCommunityIcons";

export default function App() {
  const UrlTrending = "https://api-berita-indonesia.vercel.app/cnn/terbaru";
  const UrlBola = "https://api-berita-indonesia.vercel.app/okezone/bola";
  const UrlTol = "https://api-berita-indonesia.vercel.app/tempo/travel";

  const [beritaTrending, setBeritaTrending] = useState([]);
  const [beritaBola, setBeritaBola] = useState([]);
  const [beritaTol, setBeritaTol] = useState([]);

  // const [beritaTrending, setBeritaTrending] = useState([
  //   { name: "berita 1", id: "1", pubdate },
  //   { name: "berita heboh", id: "2" },
  //   { name: "toltrending", id: "3" },
  // ]);

  useEffect(() => {
    fetch(UrlTrending)
      .then((response) => response.json())
      .then((json) => {
        // console.log(json.data.posts);
        setBeritaTrending(json.data.posts);
      });
  }, []);

  useEffect(() => {
    fetch(UrlBola)
      .then((response) => response.json())
      .then((json) => {
        // console.log(json.data.posts);
        setBeritaBola(json.data.posts);
      });
  }, []);

  useEffect(() => {
    fetch(UrlTol)
      .then((response) => response.json())
      .then((json) => {
        // console.log(json.data.posts);
        setBeritaTol(json.data.posts);
      });
  }, []);

  const Tab = createBottomTabNavigator();
  const BolaScreen = () => {
    return (
      <View style={styles.container}>
        <FlatList
          data={beritaBola}
          renderItem={({ item }) => (
            <View>
              <Text style={styles.judul}>{item.title}</Text>
              <Text style={styles.deskripsi}>{item.description}</Text>
              <Text style={styles.tanggal}>{item.pubDate}</Text>
            </View>
          )}
          keyExtractor={(item) => item.link}
        ></FlatList>
      </View>
    );
  };

  const TrendingScreen = () => {
    return (
      <View style={styles.container}>
        <FlatList
          data={beritaTrending}
          renderItem={({ item }) => (
            <View>
              <Text style={styles.judul}>{item.title}</Text>
              <Text style={styles.deskripsi}>{item.description}</Text>
              <Text style={styles.tanggal}>{item.pubDate}</Text>
            </View>
          )}
          keyExtractor={(item) => item.link}
        ></FlatList>
      </View>
    );
  };

  const JalanTolScreen = () => {
    return (
      <View style={styles.container}>
        <FlatList
          data={beritaTol}
          renderItem={({ item }) => (
            <View>
              <Text style={styles.judul}>{item.title}</Text>
              <Text style={styles.deskripsi}>{item.description}</Text>
              <Text style={styles.tanggal}>{item.pubDate}</Text>
            </View>
          )}
          keyExtractor={(item) => item.link}
        ></FlatList>
      </View>
    );
  };
  return (
    <NavigationContainer>
      <Tab.Navigator initialRouteName="Trending">
        <Tab.Screen
          name="Bola"
          component={BolaScreen}
          options={{
            tabBarLabel: "Bola",
            tabBarIcon: ({ color, size }) => {
              return <Icon name="baseball" size={size} color={color} />;
            },
          }}
        />
        <Tab.Screen
          name="Trending"
          component={TrendingScreen}
          options={{
            tabBarLabel: "Trending",
            tabBarIcon: ({ color, size }) => {
              return <Icon name="fire" size={size} color={color} />;
            },
          }}
        />
        <Tab.Screen
          name="JalanTol"
          component={JalanTolScreen}
          options={{
            tabBarLabel: "Jalan tol",
            tabBarIcon: ({ color, size }) => {
              return <Icon name="road-variant" size={size} color={color} />;
            },
          }}
        />
      </Tab.Navigator>
    </NavigationContainer>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#fff",
    alignItems: "center",
    justifyContent: "center",
  },
  judul: {
    fontWeight: "bold",
    marginTop: 30,
    marginLeft: 10,
  },
  deskripsi: {
    marginTop: 10,
    marginLeft: 10,
    paddingBottom: 10,
  },
  tanggal: {
    marginLeft: 10,
  },
});
